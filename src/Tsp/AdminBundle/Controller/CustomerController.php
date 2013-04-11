<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Flat;
use Tsp\AdminBundle\Model\FlatQuery;
use Tsp\AdminBundle\Form\FlatType;

class CustomerController extends Controller
{

    public function indexAction()
    {
        $customers = CustomerQuery::create()
            ->orderById()
            ->find();

        return $this->render('AdminBundle:Customer:index.html.twig', array('customers' => $customers));
    }

    public function newAction()
    {
        $customer = new Customer();
        $form = $this->createForm(new CustomerType(), $customer);

        return $this->render('AdminBundle:Customer:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $customer  = new Customer();
        $request = $this->getRequest();
        $form    = $this->createForm(new CustomerType(), $customer);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $customer->save();
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_customer', array('id' => $customer->getId())));
            }
        }

        return $this->render('AdminBundle:Customer:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $customer = CustomerQuery::create()->findPk($id);

        if (!$customer) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new CustomerType(), $customer);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Customer:edit.html.twig', array(
            'customer'      => $customer,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $customer = CustomerQuery::create()->findPk($id);

        if (!$customer) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:Customer:show.html.twig', array(
            'customer' => $customer
        ));

    }

    public function updateAction($id)
    {
        $customer = FlatQuery::create()->findPk($id);

        if (!$customer) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new CustomerType(), $customer);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $customer->save();
            return $this->redirect($this->generateUrl('edit_customer', array('id' => $id)));
        }

        return $this->render('AdminBundle:Flat:edit.html.twig', array(
            'customer'      => $customer,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $customer = CustomerQuery::create()->findPk($id);

        if (!$customer) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $customer->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        return $this->redirect($this->generateUrl('list_customer'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
