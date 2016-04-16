<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Form\FeedbackType;
use Site\MainBundle\Form\Feedback;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction($slug = null)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');
        $repository_service = $this->getDoctrine()->getRepository('SiteMainBundle:Service');
        $repository_sliders = $this->getDoctrine()->getRepository('SiteMainBundle:Background');

        if(is_null($slug)){
            $page = $repository_page->findOneBySlug('glavnaia');
        }else{
            $page = $repository_page->findOneBySlug($slug);
        }

        $projects = $repository_project->findBy(array('onMain' => true));
        $services = $repository_service->findAll();
        $sliders = $repository_sliders->findBy(array('main' => true));
        $form = $this->createCreateForm(new Feedback());

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'page' => $page,
            'projects' => $projects,
            'services' => $services,
            'sliders' => $sliders,
            'form' => $form->createView()
        ));
    }
    public function contactsAction()
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $page = $repository_page->findOneBySlug('kontakty');

        $form = $this->createCreateForm(new Feedback());

        return $this->render('SiteMainBundle:Frontend/Main:contacts.html.twig', array(
            'page' => $page,
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function feedbackAction(Request $request, $local, $idModuleHeader){
        $repository_module_header = $this->getDoctrine()->getRepository('SiteMainBundle:ModuleHeader');
        $moduleHeader = $repository_module_header->find($idModuleHeader);

        if (!$moduleHeader) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.module_header.not_found'));
        }

        $feedback = new Feedback();
        $form = $this->createForm(new FeedbackType(), $feedback);

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $settings = $this->getDoctrine()->getRepository('SiteMainBundle:Settings')->findAllArray();

                $mailer_host = !empty($moduleHeader->getMailerHost()) ? $moduleHeader->getMailerHost() : $settings['mailer_host'];
                $mailer_user = !empty($moduleHeader->getMailerUser()) ? $moduleHeader->getMailerUser() : $settings['mailer_user'];
                $mailer_password = !empty($moduleHeader->getMailerPassword()) ? $moduleHeader->getMailerPassword() : $settings['mailer_password'];
                $theme_letter = !empty($moduleHeader->getThemeLetter()) ? $moduleHeader->getThemeLetter() : $settings['theme_letter'];
                $email_from = !empty($moduleHeader->getEmailFrom()) ? $moduleHeader->getEmailFrom() : $settings['email_from'];
                $email_from_title = !empty($moduleHeader->getEmailFromTitle()) ? $moduleHeader->getEmailFromTitle() : $settings['email_from_title'];
                $email_to = !empty($moduleHeader->getEmailTo()) ? $moduleHeader->getEmailTo() : $settings['email_to'];

                $transport = \Swift_SmtpTransport::newInstance($mailer_host, 465, 'ssl')
                    ->setUsername($mailer_user)
                    ->setPassword($mailer_password);

                $mailer = \Swift_Mailer::newInstance($transport);

                $swift = \Swift_Message::newInstance()
                    ->setSubject($theme_letter)
                    ->setFrom(array($email_from => $email_from_title))
                    ->setTo(array_map('trim', explode(',', $email_to)))
                    ->setBody(
                        $this->renderView(
                            'SiteMainBundle:Frontend/Feedback:message.html.twig',
                            array(
                                'form' => $feedback,
                                'settings' => $settings
                            )
                        )
                        , 'text/html'
                    );

                $mailer->send($swift);

                return new Response('Сообщение успешно отправлено!', 200);
            }

            return new Response('Ошибка!', 500);
        }

        return $this->render('SiteMainBundle:Frontend/Feedback:form.html.twig', array(
            'form' => $form->createView(),
            'local' => $local,
            'idModuleHeader' => $idModuleHeader
        ));
    }


    /**
     * Создание формы обратной связи
     *
     * @param Feedback $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Feedback $entity)
    {
        $form = $this->createForm(new FeedbackType(), $entity);

        return $form;
    }
}
