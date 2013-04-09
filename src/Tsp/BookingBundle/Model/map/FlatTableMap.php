<?php

namespace Tsp\BookingBundle\Model\map;

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
 * @package    propel.generator.src.Tsp.BookingBundle.Model.map
 */
class FlatTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.BookingBundle.Model.map.FlatTableMap';

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
        $this->setClassname('Tsp\\BookingBundle\\Model\\Flat');
        $this->setPackage('src.Tsp.BookingBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 100, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 100, null);
        $this->addColumn('postcode', 'Postcode', 'VARCHAR', false, 6, null);
        $this->addColumn('street', 'Street', 'VARCHAR', false, 30, null);
        $this->addColumn('number', 'Number', 'VARCHAR', false, 5, null);
        $this->addColumn('floor', 'Floor', 'VARCHAR', false, 5, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Room', 'Tsp\\BookingBundle\\Model\\Room', RelationMap::ONE_TO_MANY, array('id' => 'flat_id', ), null, null, 'Rooms');
    } // buildRelations()

} // FlatTableMap
