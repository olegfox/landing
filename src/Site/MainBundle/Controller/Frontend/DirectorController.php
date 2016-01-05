<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DirectorController extends Controller
{
    public function indexAction()
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_director = $this->getDoctrine()->getRepository('SiteMainBundle:Director');

        $page = $repository_page->findOneBySlug('rukovodstvo');
        if (!$page) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }
        $directors = $repository_director->findAll();

        return $this->render('SiteMainBundle:Frontend/Director:index.html.twig', array(
            'page' => $page,
            'directors' => $directors
        ));
    }
}
