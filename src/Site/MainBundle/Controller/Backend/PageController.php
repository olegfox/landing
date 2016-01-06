<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Site\MainBundle\Entity\Page;
use Site\MainBundle\Form\PageType;

/**
 * Page controller.
 *
 */
class PageController extends Controller
{

    /**
     * Creates a new Page entity.
     *
     */
    public function createAction(Request $request, $project_id)
    {
        $entity = new Page();
        $form = $this->createCreateForm($entity, $project_id);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $project = $this->getDoctrine()->getRepository('SiteMainBundle:Project')->find($project_id);

            if(!$project) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.project.not_found'));
            }

            $entity->setProject($project);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_page_show', array('id' => $entity->getId(), 'project_id' => $project_id)));
        }

        return $this->render('SiteMainBundle:Backend/Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Page entity.
     *
     * @param Page $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Page $entity, $project_id)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('backend_page_create', array('project_id' => $project_id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Page entity.
     *
     */
    public function newAction($project_id)
    {
        $entity = new Page();
        $form   = $this->createCreateForm($entity, $project_id);

        return $this->render('SiteMainBundle:Backend/Page:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Page entity.
     *
     */
    public function showAction($id, $project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id, $project_id);

        return $this->render('SiteMainBundle:Backend/Page:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Page entity.
     *
     */
    public function editAction($id, $project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $editForm = $this->createEditForm($entity, $project_id);
        $deleteForm = $this->createDeleteForm($id, $project_id);

        return $this->render('SiteMainBundle:Backend/Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Page entity.
    *
    * @param Page $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Page $entity, $project_id)
    {
        $form = $this->createForm(new PageType(), $entity, array(
            'action' => $this->generateUrl('backend_page_update', array('id' => $entity->getId(), 'project_id' => $project_id)),
            'method' => 'PUT',
            'allow_extra_fields' => true
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing Page entity.
     *
     */
    public function updateAction(Request $request, $id, $project_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id, $project_id);
        $editForm = $this->createEditForm($entity, $project_id);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            return $this->redirect($this->generateUrl('backend_page_edit', array('id' => $id, 'project_id' => $project_id)));
        }

        return $this->render('SiteMainBundle:Backend/Page:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Page entity.
     *
     */
    public function deleteAction(Request $request, $id, $project_id)
    {
        $form = $this->createDeleteForm($id, $project_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:Page')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_project_index', array('id' => $project_id)));
    }

    /**
     * Creates a form to delete a Page entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id, $project_id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_page_delete', array('id' => $id, 'project_id' => $project_id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'backend.delete',
                'translation_domain' => 'menu',
                'attr' => array(
                    'class' => 'btn-danger'
                )
            ))
            ->getForm()
        ;
    }
}
