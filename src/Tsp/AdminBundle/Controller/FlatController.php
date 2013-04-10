<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Flat;
use Tsp\AdminBundle\Model\FlatQuery;
use Tsp\AdminBundle\Form\FlatType;

// http://propelorm.org/cookbook/symfony2/mastering-symfony2-forms-with-propel.html

class FlatController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('AdminBundle:Flat:index.html.twig', array('name' => $name));
    }

    public function newAction()
    {
        $model = new Flat();
        $form = $this->createForm(new FlatType(), $model);

        return $this->render('AdminBundle:Flat:new.html.twig', array(
            'model' => $model,
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $flat  = new Flat();
        $request = $this->getRequest();
        $form    = $this->createForm(new FlatType(), $flat);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {
                $flat->save();
                return $this->redirect($this->generateUrl('show_flat', array('id' => $flat->getId())));
            }
        }

        return $this->render('AdminBundle:Flat:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('PostBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Category:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $flat = FlatQuery::create()->findPk($id);

        if (!$flat) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('AdminBundle:Flat:show.html.twig', array(
            'flat' => $flat
        ));

    }

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
