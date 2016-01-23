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
    public function feedbackAction(Request $request, $local){
        $feedback = new Feedback();
        $form = $this->createForm(new FeedbackType(), $feedback);

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $settings = $this->getDoctrine()->getRepository('SiteMainBundle:Settings')->findAllArray();

                $transport = \Swift_SmtpTransport::newInstance($settings['mailer_host'], 465, 'ssl')
                    ->setUsername($settings['mailer_user'])
                    ->setPassword($settings['mailer_password']);

                $mailer = \Swift_Mailer::newInstance($transport);

                $swift = \Swift_Message::newInstance()
                    ->setSubject($settings['theme_letter'])
                    ->setFrom(array($settings['email_from'] => $settings['email_from_title']))
                    ->setTo(array_map('trim', explode(',', $settings['email_to'])))
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
            'local' => $local
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
