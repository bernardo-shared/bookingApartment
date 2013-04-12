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
use Tsp\AdminBundle\Model\Room;
use Tsp\AdminBundle\Model\BedPeer;

class BedType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('type', 'choice', array(
            'choices'  => array(
                BedPeer::TYPE_SINGLE,
                BedPeer::TYPE_SOFA,
                BedPeer::TYPE_TWW
            )));

        $builder->add('room', 'model', array(
            'class' => 'Tsp\AdminBundle\Model\Room',
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Tsp\AdminBundle\Model\Bed',
        );
    }

    public function getName()
    {
        return 'bed';
    }
}

