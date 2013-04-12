<?php

namespace Tsp\AdminBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'flat' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Tsp.AdminBundle.Model.map
 */
class FlatTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.AdminBundle.Model.map.FlatTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('flat');
        $this->setPhpName('Flat');
        $this->setClassname('Tsp\\AdminBundle\\Model\\Flat');
        $this->setPackage('src.Tsp.AdminBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 100, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, null, null);
        $this->getColumn('country', false)->setValueSet(array (
  0 => 'Spain',
  1 => 'Germany',
));
        $this->addColumn('city', 'City', 'VARCHAR', true, 100, null);
        $this->addColumn('postcode', 'Postcode', 'VARCHAR', true, 6, null);
        $this->addColumn('street', 'Street', 'VARCHAR', true, 30, null);
        $this->addColumn('number', 'Number', 'VARCHAR', true, 5, null);
        $this->addColumn('floor', 'Floor', 'VARCHAR', true, 5, null);
        // validators
        $this->addValidator('postcode', 'minLength', 'propel.validator.MinLengthValidator', '4', 'Postcode must be at least 4 characters !');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Room', 'Tsp\\AdminBundle\\Model\\Room', RelationMap::ONE_TO_MANY, array('id' => 'flat_id', ), null, null, 'Rooms');
    } // buildRelations()

} // FlatTableMap
