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
use Tsp\AdminBundle\Model\FlatPeer;

class FlatType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('country')
            ->add('city')
            ->add('postcode')
            ->add('street')
            ->add('number')
            ->add('floor');

        $builder->add('country', 'choice', array(
            'choices'  => array(
                FlatPeer::COUNTRY_SPAIN => FlatPeer::COUNTRY_SPAIN,
                FlatPeer::COUNTRY_GERMANY => FlatPeer::COUNTRY_GERMANY
            )));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Tsp\AdminBundle\Model\Flat',
        );
    }

    public function getName()
    {
        return 'flat';
    }
}

