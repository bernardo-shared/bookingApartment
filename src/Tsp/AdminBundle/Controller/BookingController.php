<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Booking;
use Tsp\AdminBundle\Model\BookingQuery;
use Tsp\AdminBundle\Form\BookingType;

class BookingController extends Controller
{

    public function indexAction()
    {
        $bookings = BookingQuery::create()
            ->filterByEndDate(date('Y-m-d'), ">=")
            ->orderById('desc')
            ->find();

        return $this->render('AdminBundle:Booking:index.html.twig', array('bookings' => $bookings));
    }

    public function historyAction()
    {
        $bookings = BookingQuery::create()
            ->filterByEndDate(date('Y-m-d'), '<')
            ->orderById()
            ->find();

        return $this->render('AdminBundle:Booking:history.html.twig', array('bookings' => $bookings));
    }

    public function newAction()
    {
        $booking = new Booking();
        $form = $this->createForm(new BookingType(), $booking);

        return $this->render('AdminBundle:Booking:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $booking  = new Booking();
        $request = $this->getRequest();
        $form    = $this->createForm(new BookingType(), $booking);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $booking->save();
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_booking', array('id' => $booking->getId())));
            }
        }

        return $this->render('AdminBundle:Booking:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $booking = BookingQuery::create()->findPk($id);

        if (!$booking) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new BookingType(), $booking);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Booking:edit.html.twig', array(
            'booking'      => $booking,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $booking = BookingQuery::create()->findPk($id);

        if (!$booking) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:Booking:show.html.twig', array(
            'booking' => $booking
        ));

    }

    public function updateAction($id)
    {
        $booking = BookingQuery::create()->findPk($id);

        if (!$booking) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new BookingType(), $booking);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $booking->save();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('edit_booking', array('id' => $id)));
        }

        return $this->render('AdminBundle:Booking:edit.html.twig', array(
            'booking'      => $booking,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $booking = BookingQuery::create()->findPk($id);
        $request = $this->get('request');
        $origin = $request->get('origin');

        if (!$booking) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $booking->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        if ('history' == $origin) {
            return $this->redirect($this->generateUrl('history_booking'));
        } else {
            return $this->redirect($this->generateUrl('list_booking'));
        }
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
