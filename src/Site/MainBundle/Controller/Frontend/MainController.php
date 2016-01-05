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

    public function feedbackAction(Request $request){
        $feedback = new Feedback();
        $form = $this->createForm(new FeedbackType(), $feedback);

        $form->handleRequest($request);

        if($form->isValid()){
            $swift = \Swift_Message::newInstance()
                ->setSubject('(Новое письмо)')
                ->setFrom(array($this->container->getParameter('email_from') => "Новое письмо с сайта"))
                ->setTo($this->container->getParameter('emails_admin'))
                ->setBody(
                    $this->renderView(
                        'SiteMainBundle:Frontend/Feedback:message.html.twig',
                        array(
                            'form' => $feedback
                        )
                    )
                    , 'text/html'
                );
            $this->get('mailer')->send($swift);

            return new JsonResponse([
                'status' => 'OK',
                'message' => 'Ваше письмо успешно отправлено. Мы скоро с вами свяжемся!'
            ]);
        } else {
            if ($form->count()) {
                foreach ($form as $child) {
                    if (!$child->isValid()) {
                        $errors[$child->getName()]['status'] = 'ERROR';
                    } else {
                        $errors[$child->getName()]['status'] = "OK";
                    }
                }
            }

            return new JsonResponse(array_merge(['status' => 'ERROR'], $errors));
        }
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
