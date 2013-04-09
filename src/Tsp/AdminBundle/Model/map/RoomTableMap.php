<?php

namespace Tsp\AdminBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'room' table.
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
class RoomTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Tsp.AdminBundle.Model.map.RoomTableMap';

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
        $this->setName('room');
        $this->setPhpName('Room');
        $this->setClassname('Tsp\\AdminBundle\\Model\\Room');
        $this->setPackage('src.Tsp.AdminBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 100, null);
        $this->getColumn('description', false)->setPrimaryString(true);
        $this->addForeignKey('flat_id', 'FlatId', 'INTEGER', 'flat', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Flat', 'Tsp\\AdminBundle\\Model\\Flat', RelationMap::MANY_TO_ONE, array('flat_id' => 'id', ), null, null);
        $this->addRelation('Bed', 'Tsp\\AdminBundle\\Model\\Bed', RelationMap::ONE_TO_MANY, array('id' => 'room_id', ), null, null, 'Beds');
    } // buildRelations()

} // RoomTableMap
