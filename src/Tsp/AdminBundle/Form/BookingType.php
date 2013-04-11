<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bernardo
 * Date: 4/9/13
 * Time: 4:20 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Tsp\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('customer_id')
            ->add('start_date')
            ->add('end_date')
            ->add('bed_id');
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Tsp\AdminBundle\Model\Booking',
        );
    }

    public function getName()
    {
        return 'booking';
    }
}

