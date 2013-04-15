<?php

namespace Tsp\FrontBundle\Resources\forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class formBook extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('start_date', 'date', array(
                'required' => true,
                'widget' => 'single_text',
                'format' => 'DD/MM/YYYY'
            ))
            ->add('end_date', 'date', array(
                'required' => true,
                'widget' => 'single_text',
                'format' => 'DD/MM/YYYY'
            ))
            ->getForm();
    }

    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);
        $options['csrf_protection'] = false;

        return $options;
    }

    public function getName()
    {
        return 'book';
    }
}
