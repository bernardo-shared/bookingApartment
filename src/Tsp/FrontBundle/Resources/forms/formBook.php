<?php

namespace Tsp\FrontBundle\Resources\forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class formBook extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('start_date', 'date', array('required' => true))
            ->add('end_date', 'date', array('required' => true))
            ->getForm();
    }

    public function getName()
    {
        return 'name';
    }
}
