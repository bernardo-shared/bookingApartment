<?php

namespace Tsp\BookingBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'customer' table.
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
class CustomerTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.BookingBundle.Model.map.CustomerTableMap';

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
        $this->setName('customer');
        $this->setPhpName('Customer');
        $this->setClassname('Tsp\\BookingBundle\\Model\\Customer');
        $this->setPackage('src.Tsp.BookingBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 10, null);
        $this->getColumn('username', false)->setPrimaryString(true);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 100, null);
        $this->getColumn('email', false)->setPrimaryString(true);
        $this->addColumn('password', 'Password', 'VARCHAR', false, 100, null);
        $this->getColumn('password', false)->setPrimaryString(true);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Booking', 'Tsp\\BookingBundle\\Model\\Booking', RelationMap::ONE_TO_MANY, array('id' => 'customer_id', ), null, null, 'Bookings');
    } // buildRelations()

} // CustomerTableMap
