<?php

namespace Tsp\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Tsp\FrontBundle\Resources\forms\formLogin;
use Tsp\FrontBundle\Resources\forms\formRegister;
use Tsp\FrontBundle\Resources\forms\formBook;

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
        $request = $this->getRequest();
        $register = $this->createForm(new formRegister(), $customer);

        if ('POST' === $request->getMethod())
        {
            $register->bindRequest($request);

            if ($register->isValid()) {
                $customer->save();
                return $this->redirect($this->generateUrl('show_user', array('id' => $customer->getId())));
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

        $book = $this->createForm(
            new formBook()
        );

        $flat = FlatQuery::create()->findPk($id);
        $room = RoomQuery::create()->findByFlatId($id);

        $request = $this->getRequest();

        if (!$flat) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        if (!$room) {
            throw $this->createNotFoundException(
                'No flat found for id '.$id
            );
        }

        if ('POST' === $request->getMethod())
        {
            $book->bindRequest($request);

            if ($book->isValid()) {

                $startDate = $request->get('start_date');
                $endDate = $request->get('end_date');

            }
        }

        return $this->render('FrontBundle:Default:show.html.twig', array(
            'flat' => $flat,
            'login' => $login->createView(),
            'rooms' => $room,
            'book' => $book->createView()
        ));

    }


}
