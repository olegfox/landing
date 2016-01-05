<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Form\FeedbackType;
use Site\MainBundle\Form\Feedback;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * Get one news
     *
     * @param $slug
     * @return Response
     */
    public function oneAction($slug)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_photo_biography = $this->getDoctrine()->getRepository('SiteMainBundle:PhotoBiography');
        $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');
        $repository_comments = $this->getDoctrine()->getRepository('SiteMainBundle:Comments');
        $repository_media = $this->getDoctrine()->getRepository('SiteMainBundle:Media');
        $repository_activity = $this->getDoctrine()->getRepository('SiteMainBundle:Activity');

        $page = $repository_page->findOneBySlug('novosti');
        $pages = $repository_page->findAll();
        $photos = $repository_photo_biography->findAll();
        $news = $repository_news->findAll();
        $newsOne = $repository_news->findOneBySlug($slug);
        $newsLast = $repository_news->findLastAll(3);
        $comments = $repository_comments->findAll();
        $commentsLast = $repository_comments->findLastAll(3);
        $media = $repository_media->findAll();
        $activity = $repository_activity->findAll();

        $form = $this->createCreateForm(new Feedback());

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'page' => $page,
            'pages' => $pages,
            'photos' => $photos,
            'news' => $news,
            'newsOne' => $newsOne,
            'newsLast' => $newsLast,
            'comments' => $comments,
            'commentsLast' => $commentsLast,
            'media' => $media,
            'activity' => $activity,
            'form' => $form->createView()
        ));
    }

    /**
     * Get one news ajax
     *
     * @param $slug
     * @return Response
     */
    public function ajaxOneAction($slug)
    {
        $repository_news = $this->getDoctrine()->getRepository('SiteMainBundle:News');

        $newsOne = $repository_news->findOneBySlug($slug);

        return new Response($this->renderView('SiteMainBundle:Frontend/News:one.html.twig', array(
            'newsOne' => $newsOne
        )));
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
