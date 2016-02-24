<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Site\MainBundle\Service\Export;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Site\MainBundle\Entity\ModuleFormField as Field;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectController extends Controller
{
    /**
     * Ссылка на лендинг для предварительного просмотра
     *
     * @param $slug
     * @return Response
     */
    public function indexAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        return $this->render('SiteMainBundle:Frontend/Project:index.html.twig', array(
            'project' => $project
        ));
    }

    /**
     * Ссылка на лендинг для локальной копии
     *
     * @param $slug
     * @return Response
     */
    public function indexLocalAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        return $this->render('SiteMainBundle:Frontend/Project:index.local.html.twig', array(
            'project' => $project
        ));
    }

    /**
     * Генерация zip архива с лендингом
     *
     * @param $slug
     * @return Response
     */
    public function generateHtmlAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        $fs = new Filesystem();

        // Имя временного каталога
        $tmpName = mt_rand();
        $dir = 'export/src/' . $tmpName . '/';

        // Создание временного каталога для экспорта
        try {
            $fs->mkdir($dir);
        } catch (IOExceptionInterface $e) {
            echo "An error occurred while creating your directory at " . $e->getPath();
        }

        // Сохранение html файла во временный каталог
        $htmlContentFile = $this->renderView('SiteMainBundle:Frontend/Project:index.local.html.twig', array(
            'project' => $project
        ));
        file_put_contents($dir . 'index.html', $htmlContentFile);

        // Сохранение стилей, скриптов и картинок во временный каталог
        Export::rcopy('bundles/sitemain/frontend/', $dir);
        Export::rcopy('uploads/images/', $dir . 'uploads/images/');
        Export::rcopy('cache/', $dir . 'cache/');
        Export::rcopy('uploads/' . $project->getSlug() . '/', $dir . 'uploads/' . $project->getSlug() . '/');

        // Создание zip архива
        $dirZip = 'export/zip/';
        Export::zip($dir, $dirZip . $project->getSlug() . '.zip');

        // Удаление временного каталога
        Export::rrmdir($dir);

        $response = new Response(file_get_contents($dirZip . $project->getSlug() . '.zip'));

        $d = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $project->getSlug() . '.zip');
        $response->headers->set('Content-Disposition', $d);

        return $response;
    }

    public function createFormAction(Request $request, $slug, $level){
        $repository_level = $this->getDoctrine()->getRepository('SiteMainBundle:Level');
        $repository_module_form_field = $this->getDoctrine()->getRepository('SiteMainBundle:ModuleFormField');

        $lev = $repository_level->findOneBySlug($level);

        $moduleForm = $lev->getModuleForm();

        $formBuilder =  $this->createFormBuilder()
            ->setAction($this->generateUrl('frontend_project_form', array('slug' => $slug, 'level' => $level)));

        foreach($moduleForm->getFields() as $field) {

            $params = array();

            // Label field
            if($field->getEnableLabel()) {
                $params = array_merge($params, array(
                    'label' => $field->getTitle()
                ));
            } else {
                $params = array_merge($params, array(
                    'label' => false
                ));
            }

            // Placeholder field
            if($field->getEnablePlaceholder()) {
                if(!array_key_exists('attr', $params)) {
                    $params = array_merge($params, array(
                        'attr' => array(
                            'placeholder' => $field->getPlaceholder()
                        )
                    ));
                } else {
                    $params['attr'] = array(
                        'placeholder' => $field->getPlaceholder()
                    );
                }
            }

            // Require field
            if($field->getEnableRequire()) {
                $params = array_merge($params, array(
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(array('message' => '')),
                    )
                ));
            }

            switch($field->getType()) {
                case Field::TYPE_TEXT: {
                    $formBuilder
                        ->add($field->getSlug(), 'text', $params);
                }break;
                case Field::TYPE_EMAIL: {
                    $formBuilder
                        ->add($field->getSlug(), 'email', $params);
                }break;
                case Field::TYPE_SUBMIT: {
                    $formBuilder
                        ->add($field->getSlug(), 'submit', $params);
                }break;
                default: {
                    $formBuilder
                        ->add($field->getSlug(), 'text', $params);
                }break;
            }
        }

        $form = $formBuilder->getForm();

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $transport = \Swift_SmtpTransport::newInstance($moduleForm->getMailerHost(), 465, 'ssl')
                    ->setUsername($moduleForm->getMailerUser())
                    ->setPassword($moduleForm->getMailerPassword());

                $mailer = \Swift_Mailer::newInstance($transport);

                $swift = \Swift_Message::newInstance()
                    ->setSubject($moduleForm->getMailerHost())
                    ->setFrom(array($moduleForm->getEmailFrom() => $moduleForm->getEmailFromTitle()))
                    ->setTo(array_map('trim', explode(',', $moduleForm->getEmailTo())))
                    ->setBody(
                        $this->renderView(
                            'SiteMainBundle:Frontend/Modules/ModuleForm:message.html.twig',
                            array(
                                'module' => $moduleForm,
                                'request' => $request
                            )
                        )
                        , 'text/html'
                    );

                $mailer->send($swift);

                return new JsonResponse([
                    'status' => 'OK',
                    'notice' => 'Сообщение успешно отправлено!'
                ]);
            } else {
                if ($form->count()) {
                    foreach ($form as $child) {
                        if (!$child->isValid()) {
                            $field = $repository_module_form_field->findOneBySlug($child->getName());
                            $errors[$child->getName()]['status'] = 'ERROR';
                        } else {
                            $errors[$child->getName()]['status'] = "OK";
                        }
                    }
                }

                return new JsonResponse(array_merge(['status' => 'ERROR'], array('errors' => $errors)));
            }
        }

        return $this->render('SiteMainBundle:Frontend/Modules/ModuleForm:form.html.twig', array(
            'form' => $form->createView(),
            'module' => $moduleForm
        ));
    }
}
