<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\Room;
use Tsp\AdminBundle\Model\RoomQuery;
use Tsp\AdminBundle\Form\RoomType;
use Tsp\AdminBundle\Model\BedQuery;

class RoomController extends Controller
{

    public function indexAction()
    {
        $request = $this->get('request');
        $flat_id = $request->get('flat_id');

        if ($flat_id) {
            $rooms = RoomQuery::create()->findByFlatId($flat_id);

        } else {
            $rooms = RoomQuery::create()
                ->orderById()
                ->find();
        }

        return $this->render('AdminBundle:Room:index.html.twig', array('rooms' => $rooms));
    }

    public function newAction()
    {
        $room = new Room();
        $form = $this->createForm(new RoomType(), $room);

        return $this->render('AdminBundle:Room:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $room  = new Room();
        $request = $this->getRequest();
        $form    = $this->createForm(new RoomType(), $room);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $room->save();
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_room', array('id' => $room->getId())));
            }
        }

        return $this->render('AdminBundle:Room:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $room = RoomQuery::create()->findPk($id);

        if (!$room) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new RoomType(), $room);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:Room:edit.html.twig', array(
            'room'      => $room,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $room = RoomQuery::create()->findPk($id);

        if (!$room) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:Room:show.html.twig', array(
            'room' => $room
        ));

    }

    public function updateAction($id)
    {
        $room = RoomQuery::create()->findPk($id);

        if (!$room) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new RoomType(), $room);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $room->save();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('edit_room', array('id' => $id)));
        }

        return $this->render('AdminBundle:Room:edit.html.twig', array(
            'room'      => $room,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $room = RoomQuery::create()->findPk($id);

        if (!$room) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $beds = BedQuery::create()->findByRoomId($room->getId());

            foreach ($beds as $bed) $bed->delete();

            $room->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        return $this->redirect($this->generateUrl('list_room'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
