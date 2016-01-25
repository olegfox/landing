<?php

namespace Site\MainBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;

use Site\MainBundle\Entity\Level;
use Site\MainBundle\Entity\ModuleHeader;
use Site\MainBundle\Entity\ModuleLine;
use Site\MainBundle\Entity\ModuleMap;
use Site\MainBundle\Entity\ModuleSquare;
use Site\MainBundle\Form\LevelType;

/**
 * Level controller.
 *
 */
class LevelController extends Controller
{

    /**
     * Creates a new Level entity.
     *
     */
    public function createAction(Request $request, $project_id, $page_id, $type)
    {
        $entity = new Level();
        $form = $this->createCreateForm($entity, $project_id, $page_id, $type);
        $form->handleRequest($request);

        if ($form->isValid()) {

//          Квадраты
            if(is_object($entity->getModuleSquare())) {
                foreach ($entity->getModuleSquare()->getSquares() as $square) {
                    $square->setModuleSquare($entity->getModuleSquare());
                }
            }

            $em = $this->getDoctrine()->getManager();
            $page = $this->getDoctrine()->getRepository('SiteMainBundle:Page')->find($page_id);

            if(!$page) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.page.not_found'));
            }

            $entity->setPage($page);
            $em->persist($entity);
            $em->flush();

            switch($type){
                case 'header': {
                    // Модуль шапка
                    $moduleHeader = new ModuleHeader();
                    $moduleHeader->setLevel($entity);
                    $em->persist($moduleHeader);
                    $em->flush();
                    $entity->setModuleHeader($moduleHeader);
                    $em->flush();
                }break;
                case 'line': {
                    // Модуль линия
                    $moduleLine = new ModuleLine();
                    $moduleLine->setLevel($entity);
                    $em->persist($moduleLine);
                    $em->flush();
                    $entity->setModuleLine($moduleLine);
                    $em->flush();
                }break;
                case 'square': {
                    // Модуль квадрат
                    $moduleSquare = new ModuleSquare();
                    $moduleSquare->setLevel($entity);
                    $em->persist($moduleSquare);
                    $em->flush();
                    $entity->setModuleSquare($moduleSquare);
                    $em->flush();
                }break;
                case 'map': {
                    // Модуль карта
                    $moduleMap = new ModuleMap();
                    $moduleMap->setLevel($entity);
                    $em->persist($moduleMap);
                    $em->flush();
                    $entity->setModuleMap($moduleMap);
                    $em->flush();
                }break;
                default: {
                    // Модуль шапка
                    $moduleHeader = new ModuleHeader();
                    $moduleHeader->setLevel($entity);
                    $em->persist($moduleHeader);
                    $em->flush();
                    $entity->setModuleHeader($moduleHeader);
                    $em->flush();
                }break;
            }

            $entity->setType($type);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_level_edit', array(
                'id' => $entity->getId(),
                'page_id' => $page_id,
                'project_id' => $project_id,
                'type' => $type
            )));
        }

        return $this->render('SiteMainBundle:Backend/Level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Level entity.
     *
     * @param Level $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Level $entity, $project_id, $page_id, $type)
    {
        $form = $this->createForm(new LevelType($type), $entity, array(
            'action' => $this->generateUrl('backend_level_create', array(
                'project_id' => $project_id,
                'page_id' => $page_id,
                'type' => $type
            )),
            'method' => 'POST',
        ));

        $form->remove('moduleHeader');
        $form->remove('moduleLine');
        $form->remove('moduleSquare');
        $form->remove('moduleMap');
        $form->add('submit', 'submit', array('label' => 'backend.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Level entity.
     *
     */
    public function newAction($project_id, $page_id, $type)
    {
        $entity = new Level();
        $form   = $this->createCreateForm($entity, $project_id, $page_id, $type);

        return $this->render('SiteMainBundle:Backend/Level:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Level entity.
     *
     */
    public function showAction($id, $project_id, $page_id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.level.not_found'));
        }

        $deleteForm = $this->createDeleteForm($id, $project_id, $page_id);

        return $this->render('SiteMainBundle:Backend/Level:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Level entity.
     *
     */
    public function editAction($id, $project_id, $page_id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.level.not_found'));
        }

        $editForm = $this->createEditForm($entity, $project_id, $page_id, $type);
        $deleteForm = $this->createDeleteForm($id, $project_id, $page_id);

        return $this->render('SiteMainBundle:Backend/Level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Level entity.
    *
    * @param Level $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Level $entity, $project_id, $page_id, $type)
    {
        $form = $this->createForm(new LevelType($type), $entity, array(
            'action' => $this->generateUrl('backend_level_update', array(
                'id' => $entity->getId(),
                'project_id' => $project_id,
                'page_id' => $page_id,
                'type' => $type
            )),
            'method' => 'PUT',
            'allow_extra_fields' => true
        ));

        $form->add('submit', 'submit', array('label' => 'backend.update'));

        return $form;
    }
    /**
     * Edits an existing Level entity.
     *
     */
    public function updateAction(Request $request, $id, $project_id, $page_id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SiteMainBundle:Level')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException($this->get('translator')->trans('backend.level.not_found'));
        }

//      Квадраты
        $originalSquares = new ArrayCollection();

        if(is_object($entity->getModuleSquare())) {
            foreach ($entity->getModuleSquare()->getSquares() as $square) {
                $originalSquares->add($square);
            }
        }

        $deleteForm = $this->createDeleteForm($id, $project_id, $page_id);
        $editForm = $this->createEditForm($entity, $project_id, $page_id, $type);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

//          Квадраты
            foreach ($originalSquares as $square) {

                if (false === $entity->getModuleSquare()->getSquares()->contains($square)) {

                    $entity->getModuleSquare()->getSquares()->removeElement($square);

                    $em->remove($square);

                }

            }

            if(is_object($entity->getModuleSquare())) {
                foreach ($entity->getModuleSquare()->getSquares() as $square) {
                    $square->setModuleSquare($entity->getModuleSquare());
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('backend_level_edit', array(
                'id' => $id,
                'project_id' => $project_id,
                'page_id' => $page_id,
                'type' => $type
            )));
        }

        return $this->render('SiteMainBundle:Backend/Level:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Level entity.
     *
     */
    public function deleteAction(Request $request, $id, $project_id, $page_id)
    {
        $form = $this->createDeleteForm($id, $project_id, $page_id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SiteMainBundle:Level')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException($this->get('translator')->trans('backend.level.not_found'));
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_page_show', array(
            'id' => $page_id,
            'project_id' => $project_id,
            'page_id' => $page_id
        )));
    }

    /**
     * Creates a form to delete a Level entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id, $project_id, $page_id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_level_delete', array('id' => $id, 'project_id' => $project_id, 'page_id' => $page_id)))
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
