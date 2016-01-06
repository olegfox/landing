<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProjectController extends Controller
{
    public function indexAction($slug)
    {
        $repository_project = $this->getDoctrine()->getRepository('SiteMainBundle:Project');

        $project = $repository_project->findOneBySlug($slug);

        return $this->render('SiteMainBundle:Frontend/Project:index.html.twig', array(
            'project' => $project
        ));
    }
}
