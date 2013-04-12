<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Bed;
use Tsp\AdminBundle\Model\BedQuery;
use Tsp\AdminBundle\Form\BedType;

class BedController extends Controller
{

    public function indexAction()
    {
        $beds = BedQuery::create()
            ->orderById()
            ->find();

        return $this->render('AdminBundle:Bed:index.html.twig', array('beds' => $beds));
    }

    public function newAction()
    {
        $bed = new Bed();
        $form = $this->createForm(new BedType(), $bed);

        return $this->render('AdminBundle:Bed:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $bed  = new Bed();
        $request = $this->getRequest();
        $form    = $this->createForm(new BedType(), $bed);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $bed->save();
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_bed', array('id' => $bed->getId())));
            }
        }

        return $this->render('AdminBundle:Bed:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $bed = BedQuery::create()->findPk($id);

        if (!$bed) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new BedType(), $bed);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Bed:edit.html.twig', array(
            'bed'      => $bed,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $bed = BedQuery::create()->findPk($id);

        if (!$bed) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:Bed:show.html.twig', array(
            'bed' => $bed
        ));

    }

    public function updateAction($id)
    {
        $bed = BedQuery::create()->findPk($id);

        if (!$bed) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new BedType(), $bed);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            $bed->save();
            return $this->redirect($this->generateUrl('edit_bed', array('id' => $id)));
        }

        return $this->render('AdminBundle:Bed:edit.html.twig', array(
            'bed'      => $bed,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $bed = BedQuery::create()->findPk($id);

        if (!$bed) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $bed->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        return $this->redirect($this->generateUrl('list_bed'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
