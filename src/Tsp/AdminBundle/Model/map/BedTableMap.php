<?php

namespace Tsp\AdminBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'bed' table.
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
class BedTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.AdminBundle.Model.map.BedTableMap';

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
        $this->setName('bed');
        $this->setPhpName('Bed');
        $this->setClassname('Tsp\\AdminBundle\\Model\\Bed');
        $this->setPackage('src.Tsp.AdminBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', false, 10, null);
        $this->getColumn('type', false)->setPrimaryString(true);
        $this->addForeignKey('room_id', 'RoomId', 'INTEGER', 'room', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Room', 'Tsp\\AdminBundle\\Model\\Room', RelationMap::MANY_TO_ONE, array('room_id' => 'id', ), null, null);
        $this->addRelation('Booking', 'Tsp\\AdminBundle\\Model\\Booking', RelationMap::ONE_TO_MANY, array('id' => 'bed_id', ), null, null, 'Bookings');
    } // buildRelations()

} // BedTableMap
