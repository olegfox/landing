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
        return $this->redirect($this->generateUrl('backend_project_index'));
    }

}
