<?php

namespace Tsp\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FlatController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('AdminBundle:Flat:index.html.twig', array('name' => $name));
    }
}
