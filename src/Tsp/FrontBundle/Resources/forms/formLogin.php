<?php

namespace Tsp\FrontBundle\Resources\forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class formLogin extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username', 'text', array('required' => true))
            ->add('password', 'password', array('required' => true))
            ->getForm();
    }

    public function getName()
    {
        return 'username';
    }
}
