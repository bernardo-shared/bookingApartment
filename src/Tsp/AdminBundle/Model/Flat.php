<?php

namespace Tsp\AdminBundle\Model;

use Tsp\AdminBundle\Model\om\BaseFlat;


/**
 * Skeleton subclass for representing a row from the 'flat' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.src.Tsp.AdminBundle.Model
 */
class Flat extends BaseFlat
{
    public function __toString()
    {
        return $this->getDescription();
    }
}
