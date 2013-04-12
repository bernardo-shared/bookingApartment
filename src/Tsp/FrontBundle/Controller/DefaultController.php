<?php

namespace Tsp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Tsp\FrontBundle\Resources\forms\formLogin;
use Tsp\FrontBundle\Resources\forms\formRegister;

use Tsp\AdminBundle\Model\FlatQuery;
use Tsp\AdminBundle\Model\RoomQuery;

use Tsp\AdminBundle\Model\Customer;


class DefaultController extends Controller
{

    public function indexAction()
    {
        $login = $this->createForm(
            new formLogin()
        );


        $flats = FlatQuery::create()
            ->orderById()
            ->find();




        return $this->render(
            'FrontBundle:Default:index.html.twig',
            array(
                'login' => $login->createView(), 'flats' => $flats
            )
        );
    }

    public function registerAction()
    {
        $customer = new Customer();
        $register = $this->createForm(
            new formRegister(), $customer
        );

        $request = $this->getRequest();

        if ('POST' === $request->getMethod())
        {
            $register->bindRequest($request);

            $email = $request->get('email');
            $username = $request->get('username');
            $password = $request->get('password');

            if ($register->isValid()) {

                $customer
                    ->setEmail($email)
                    ->setUsername($username)
                    ->setPassword($password);
                $customer->save();

                return $this->redirect($this->generateUrl('customer'));
            } else {
                return $this->redirect($this->generateUrl('register'));
            }
        }

        return $this->render(
            'FrontBundle:Default:register.html.twig',
            array(
                'register' => $register->createView()
            )
        );
    }


    public function customerAction()
    {
        return $this->render('FrontBundle:Default:customer.html.twig');
    }


    public function showAction($id)
    {
        $login = $this->createForm(
            new formLogin()
        );

        $flat = FlatQuery::create()->findPk($id);
        $room = RoomQuery::create()->findByFlatId($flat);

        if (!$flat) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        return $this->render('FrontBundle:Default:show.html.twig', array(
            'flat' => $flat,
            'login' => $login->createView(),
            'room' => $room
        ));

    }


}
