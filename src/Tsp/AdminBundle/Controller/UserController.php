<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tsp\AdminBundle\Model\User;
use Tsp\AdminBundle\Model\UserQuery;
use Tsp\AdminBundle\Form\UserType;

class UserController extends Controller
{

    public function indexAction()
    {
        $users = UserQuery::create()
            ->orderById()
            ->find();

        return $this->render('AdminBundle:User:index.html.twig', array('users' => $users));
    }

    public function newAction()
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        return $this->render('AdminBundle:User:new.html.twig', array(
            'form'   => $form->createView()
        ));
    }

    public function createAction()
    {
        $user  = new User();
        $request = $this->getRequest();
        $form    = $this->createForm(new UserType(), $user);

        if ('POST' === $request->getMethod()) {

            $form->bindRequest($request);

            if ($form->isValid()) {

                $user->save();
                $this->get('session')->setFlash('notice', 'Your changes were saved!');

                return $this->redirect($this->generateUrl('show_user', array('id' => $user->getId())));
            }
        }

        return $this->render('AdminBundle:User:show.html.twig', array(
            'form'   => $form->createView() // I the view get flat -> $flat = $form->getData()
        ));
    }

    public function editAction($id)
    {
        $user = UserQuery::create()->findPk($id);

        if (!$user) {
            throw $this->createNotFoundException('Unable to find Flat.');
        }

        $editForm = $this->createForm(new UserType(), $user);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AdminBundle:User:edit.html.twig', array(
            'user'      => $user,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showAction($id)
    {
        $user = UserQuery::create()->findPk($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('AdminBundle:User:show.html.twig', array(
            'user' => $user
        ));

    }

    public function updateAction($id)
    {
        $user = UserQuery::create()->findPk($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $editForm   = $this->createForm(new UserType(), $user);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $user->save();
            return $this->redirect($this->generateUrl('edit_user', array('id' => $id)));
        }

        return $this->render('AdminBundle:User:edit.html.twig', array(
            'user'      => $user,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $user = UserQuery::create()->findPk($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        try {
            $user->delete();
            $this->get('session')->setFlash('notice', 'Your changes were saved!');
        } catch (Exception $e) {
            $this->get('session')->setFlash('notice', 'Error: Your changes were not saved!');
        }

        return $this->redirect($this->generateUrl('list_user'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm();
    }
}
