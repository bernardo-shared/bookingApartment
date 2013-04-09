<?php

namespace Tsp\AdminBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'booking' table.
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
class BookingTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.AdminBundle.Model.map.BookingTableMap';

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
        $this->setName('booking');
        $this->setPhpName('Booking');
        $this->setClassname('Tsp\\AdminBundle\\Model\\Booking');
        $this->setPackage('src.Tsp.AdminBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('start_date', 'StartDate', 'DATE', false, null, null);
        $this->addColumn('end_date', 'EndDate', 'DATE', false, null, null);
        $this->addForeignKey('customer_id', 'CustomerId', 'INTEGER', 'customer', 'id', false, null, null);
        $this->addForeignKey('bed_id', 'BedId', 'INTEGER', 'bed', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Customer', 'Tsp\\AdminBundle\\Model\\Customer', RelationMap::MANY_TO_ONE, array('customer_id' => 'id', ), null, null);
        $this->addRelation('Bed', 'Tsp\\AdminBundle\\Model\\Bed', RelationMap::MANY_TO_ONE, array('bed_id' => 'id', ), null, null);
    } // buildRelations()

} // BookingTableMap
