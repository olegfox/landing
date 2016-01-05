<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GroupCompanyController extends Controller
{
    public function indexAction()
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_group_company = $this->getDoctrine()->getRepository('SiteMainBundle:GroupCompany');

        $page = $repository_page->findOneBySlug('struktura');
        if (!$page) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }
        $groupCompanies = $repository_group_company->findAll();

        return $this->render('SiteMainBundle:Frontend/GroupCompany:index.html.twig', array(
            'page' => $page,
            'groupCompanies' => $groupCompanies
        ));
    }
}
