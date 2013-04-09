<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Flat;


class FlatController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('AdminBundle:Flat:index.html.twig', array('name' => $name));
    }

//    public function newAction()
//    {
//        $entity = new Category  ();
//        $form   = $this->createForm(new CategoryType(), $entity);
//
//        return $this->render('AdminBundle:Flat:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView()
//        ));
//    }
//
//    public function createAction()
//    {
//        $entity  = new Category();
//        $request = $this->getRequest();
//        $form    = $this->createForm(new CategoryType(), $entity);
//        $form->bindRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getEntityManager();
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('category_show', array('id' => $entity->getId())));
//
//        }
//
//        return $this->render('AdminBundle:Category:new.html.twig', array(
//            'entity' => $entity,
//            'form'   => $form->createView()
//        ));
//    }
//
//    public function editAction($id)
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $entity = $em->getRepository('PostBundle:Category')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Category entity.');
//        }
//
//        $editForm = $this->createForm(new CategoryType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        return $this->render('AdminBundle:Category:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    public function updateAction($id)
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $entity = $em->getRepository('PostBundle:Category')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Category entity.');
//        }
//
//        $editForm   = $this->createForm(new CategoryType(), $entity);
//        $deleteForm = $this->createDeleteForm($id);
//
//        $request = $this->getRequest();
//
//        $editForm->bindRequest($request);
//
//        if ($editForm->isValid()) {
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('category_edit', array('id' => $id)));
//        }
//
//        return $this->render('AdminBundle:Category:edit.html.twig', array(
//            'entity'      => $entity,
//            'edit_form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    public function deleteAction($id)
//    {
//        $form = $this->createDeleteForm($id);
//        $request = $this->getRequest();
//
//        $form->bindRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getEntityManager();
//            $entity = $em->getRepository('PostBundle:Category')->find($id);
//
//            if (!$entity) {
//                throw $this->createNotFoundException('Unable to find Category entity.');
//            }
//
//            $em->remove($entity);
//            $em->flush();
//        }
//
//        return $this->redirect($this->generateUrl('category'));
//    }
//
//    private function createDeleteForm($id)
//    {
//        return $this->createFormBuilder(array('id' => $id))
//            ->add('id', 'hidden')
//            ->getForm()
//            ;
//    }
}
