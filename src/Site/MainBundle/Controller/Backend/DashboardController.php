<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Dashboard controller.
 *
 */
class DashboardController extends Controller
{

    public function indexAction()
    {
        return $this->render('SiteMainBundle:Backend/Dashboard:index.html.twig');
    }

}
