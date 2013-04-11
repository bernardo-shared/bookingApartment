<?php

namespace Tsp\FrontBundle\Resources\forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class formRegister extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('required' => true))
            ->add('username', 'text', array('required' => true))
            ->add('password', 'password', array('required' => true))
            ->getForm();
    }

    public function getName()
    {
        return 'username';
    }
}
