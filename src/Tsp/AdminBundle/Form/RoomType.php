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
use Tsp\AdminBundle\Form\FlatType;
use Tsp\AdminBundle\Form\BedType;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('description');

        $builder->add('flat', 'model', array(
            'class' => 'Tsp\AdminBundle\Model\Flat',
        ));

//        $builder->add('bed', 'collection', array(
//            'type'          => 'model',
//            'options' => array(
//                'class'     => 'Tsp\AdminBundle\Model\Bed',
//                'property'  => 'type',
//            ),
//            'allow_add'     => true,
//            'allow_delete'  => true,
//            'by_reference'  => false,
//        ));

        //$builder->add('flat', new FlatType());

//        $builder->add('flat', 'model', array(
//            'class' => 'Tsp\AdminBundle\Model\Flat',
//        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Tsp\AdminBundle\Model\Room',
        );
    }

    public function getName()
    {
        return 'room';
    }
}

