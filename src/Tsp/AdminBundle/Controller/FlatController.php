<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Flat;
use Tsp\AdminBundle\Model\FlatQuery;
use Tsp\AdminBundle\Form\FlatType;

class FlatController extends Controller
{

    public function indexAction()
    {
        $flats = FlatQuery::create()
            ->orderById()
            ->find();

        return $this->render('AdminBundle:Flat:index.html.twig', array('flats' => $flats));
    }

    public function newAction()
    {
        $model = new Flat();
        $form = $this->createForm(new FlatType(), $model);

        return $this->render('AdminBundle:Flat:new.html.twig', array(
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
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_flat', array('id' => $flat->getId())));
            }
        }

        return $this->render('AdminBundle:Flat:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $flat = FlatQuery::create()->findPk($id);

        if (!$flat) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new FlatType(), $flat);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Flat:edit.html.twig', array(
            'flat'      => $flat,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $flat = FlatQuery::create()->findPk($id);

        if (!$flat) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:Flat:show.html.twig', array(
            'flat' => $flat
        ));

    }

    public function updateAction($id)
    {
        $flat = FlatQuery::create()->findPk($id);

        if (!$flat) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new FlatType(), $flat);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $flat->save();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('edit_flat', array('id' => $id)));
        }

        return $this->render('AdminBundle:Flat:edit.html.twig', array(
            'flat'      => $flat,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $flat = FlatQuery::create()->findPk($id);

        if (!$flat) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $flat->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        return $this->redirect($this->generateUrl('list_flat'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
