<?php

namespace Tsp\AdminBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Tsp\AdminBundle\Model\Flat;
use Tsp\AdminBundle\Model\FlatPeer;
use Tsp\AdminBundle\Model\FlatQuery;
use Tsp\AdminBundle\Model\Room;
use Tsp\AdminBundle\Model\RoomQuery;

/**
 * Base class that represents a row from the 'flat' table.
 *
 *
 *
 * @package    propel.generator.src.Tsp.AdminBundle.Model.om
 */
abstract class BaseFlat extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Tsp\\AdminBundle\\Model\\FlatPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        FlatPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the description field.
     * @var        string
     */
    protected $description;

    /**
     * The value for the country field.
     * @var        string
     */
    protected $country;

    /**
     * The value for the city field.
     * @var        string
     */
    protected $city;

    /**
     * The value for the postcode field.
     * @var        string
     */
    protected $postcode;

    /**
     * The value for the street field.
     * @var        string
     */
    protected $street;

    /**
     * The value for the number field.
     * @var        string
     */
    protected $number;

    /**
     * The value for the floor field.
     * @var        string
     */
    protected $floor;

    /**
     * @var        PropelObjectCollection|Room[] Collection to store aggregation of Room objects.
     */
    protected $collRooms;
    protected $collRoomsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $roomsScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [country] column value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the [city] column value.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the [postcode] column value.
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Get the [street] column value.
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Get the [number] column value.
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get the [floor] column value.
     *
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = FlatPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [description] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[] = FlatPeer::DESCRIPTION;
        }


        return $this;
    } // setDescription()

    /**
     * Set the value of [country] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setCountry($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->country !== $v) {
            $this->country = $v;
            $this->modifiedColumns[] = FlatPeer::COUNTRY;
        }


        return $this;
    } // setCountry()

    /**
     * Set the value of [city] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setCity($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->city !== $v) {
            $this->city = $v;
            $this->modifiedColumns[] = FlatPeer::CITY;
        }


        return $this;
    } // setCity()

    /**
     * Set the value of [postcode] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setPostcode($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->postcode !== $v) {
            $this->postcode = $v;
            $this->modifiedColumns[] = FlatPeer::POSTCODE;
        }


        return $this;
    } // setPostcode()

    /**
     * Set the value of [street] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setStreet($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->street !== $v) {
            $this->street = $v;
            $this->modifiedColumns[] = FlatPeer::STREET;
        }


        return $this;
    } // setStreet()

    /**
     * Set the value of [number] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setNumber($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->number !== $v) {
            $this->number = $v;
            $this->modifiedColumns[] = FlatPeer::NUMBER;
        }


        return $this;
    } // setNumber()

    /**
     * Set the value of [floor] column.
     *
     * @param string $v new value
     * @return Flat The current object (for fluent API support)
     */
    public function setFloor($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->floor !== $v) {
            $this->floor = $v;
            $this->modifiedColumns[] = FlatPeer::FLOOR;
        }


        return $this;
    } // setFloor()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->description = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->country = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->city = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->postcode = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->street = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->number = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->floor = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 8; // 8 = FlatPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Flat object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FlatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = FlatPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collRooms = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FlatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = FlatQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(FlatPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                FlatPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->roomsScheduledForDeletion !== null) {
                if (!$this->roomsScheduledForDeletion->isEmpty()) {
                    foreach ($this->roomsScheduledForDeletion as $room) {
                        // need to save related object because we set the relation to null
                        $room->save($con);
                    }
                    $this->roomsScheduledForDeletion = null;
                }
            }

            if ($this->collRooms !== null) {
                foreach ($this->collRooms as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = FlatPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . FlatPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(FlatPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(FlatPeer::DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = '`description`';
        }
        if ($this->isColumnModified(FlatPeer::COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`country`';
        }
        if ($this->isColumnModified(FlatPeer::CITY)) {
            $modifiedColumns[':p' . $index++]  = '`city`';
        }
        if ($this->isColumnModified(FlatPeer::POSTCODE)) {
            $modifiedColumns[':p' . $index++]  = '`postcode`';
        }
        if ($this->isColumnModified(FlatPeer::STREET)) {
            $modifiedColumns[':p' . $index++]  = '`street`';
        }
        if ($this->isColumnModified(FlatPeer::NUMBER)) {
            $modifiedColumns[':p' . $index++]  = '`number`';
        }
        if ($this->isColumnModified(FlatPeer::FLOOR)) {
            $modifiedColumns[':p' . $index++]  = '`floor`';
        }

        $sql = sprintf(
            'INSERT INTO `flat` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`description`':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case '`country`':
                        $stmt->bindValue($identifier, $this->country, PDO::PARAM_STR);
                        break;
                    case '`city`':
                        $stmt->bindValue($identifier, $this->city, PDO::PARAM_STR);
                        break;
                    case '`postcode`':
                        $stmt->bindValue($identifier, $this->postcode, PDO::PARAM_STR);
                        break;
                    case '`street`':
                        $stmt->bindValue($identifier, $this->street, PDO::PARAM_STR);
                        break;
                    case '`number`':
                        $stmt->bindValue($identifier, $this->number, PDO::PARAM_STR);
                        break;
                    case '`floor`':
                        $stmt->bindValue($identifier, $this->floor, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = FlatPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collRooms !== null) {
                    foreach ($this->collRooms as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = FlatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getDescription();
                break;
            case 2:
                return $this->getCountry();
                break;
            case 3:
                return $this->getCity();
                break;
            case 4:
                return $this->getPostcode();
                break;
            case 5:
                return $this->getStreet();
                break;
            case 6:
                return $this->getNumber();
                break;
            case 7:
                return $this->getFloor();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Flat'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Flat'][$this->getPrimaryKey()] = true;
        $keys = FlatPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getDescription(),
            $keys[2] => $this->getCountry(),
            $keys[3] => $this->getCity(),
            $keys[4] => $this->getPostcode(),
            $keys[5] => $this->getStreet(),
            $keys[6] => $this->getNumber(),
            $keys[7] => $this->getFloor(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collRooms) {
                $result['Rooms'] = $this->collRooms->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = FlatPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setDescription($value);
                break;
            case 2:
                $this->setCountry($value);
                break;
            case 3:
                $this->setCity($value);
                break;
            case 4:
                $this->setPostcode($value);
                break;
            case 5:
                $this->setStreet($value);
                break;
            case 6:
                $this->setNumber($value);
                break;
            case 7:
                $this->setFloor($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = FlatPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDescription($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setCountry($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCity($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPostcode($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setStreet($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNumber($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setFloor($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(FlatPeer::DATABASE_NAME);

        if ($this->isColumnModified(FlatPeer::ID)) $criteria->add(FlatPeer::ID, $this->id);
        if ($this->isColumnModified(FlatPeer::DESCRIPTION)) $criteria->add(FlatPeer::DESCRIPTION, $this->description);
        if ($this->isColumnModified(FlatPeer::COUNTRY)) $criteria->add(FlatPeer::COUNTRY, $this->country);
        if ($this->isColumnModified(FlatPeer::CITY)) $criteria->add(FlatPeer::CITY, $this->city);
        if ($this->isColumnModified(FlatPeer::POSTCODE)) $criteria->add(FlatPeer::POSTCODE, $this->postcode);
        if ($this->isColumnModified(FlatPeer::STREET)) $criteria->add(FlatPeer::STREET, $this->street);
        if ($this->isColumnModified(FlatPeer::NUMBER)) $criteria->add(FlatPeer::NUMBER, $this->number);
        if ($this->isColumnModified(FlatPeer::FLOOR)) $criteria->add(FlatPeer::FLOOR, $this->floor);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(FlatPeer::DATABASE_NAME);
        $criteria->add(FlatPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Flat (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDescription($this->getDescription());
        $copyObj->setCountry($this->getCountry());
        $copyObj->setCity($this->getCity());
        $copyObj->setPostcode($this->getPostcode());
        $copyObj->setStreet($this->getStreet());
        $copyObj->setNumber($this->getNumber());
        $copyObj->setFloor($this->getFloor());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getRooms() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRoom($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Flat Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return FlatPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new FlatPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Room' == $relationName) {
            $this->initRooms();
        }
    }

    /**
     * Clears out the collRooms collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Flat The current object (for fluent API support)
     * @see        addRooms()
     */
    public function clearRooms()
    {
        $this->collRooms = null; // important to set this to null since that means it is uninitialized
        $this->collRoomsPartial = null;

        return $this;
    }

    /**
     * reset is the collRooms collection loaded partially
     *
     * @return void
     */
    public function resetPartialRooms($v = true)
    {
        $this->collRoomsPartial = $v;
    }

    /**
     * Initializes the collRooms collection.
     *
     * By default this just sets the collRooms collection to an empty array (like clearcollRooms());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRooms($overrideExisting = true)
    {
        if (null !== $this->collRooms && !$overrideExisting) {
            return;
        }
        $this->collRooms = new PropelObjectCollection();
        $this->collRooms->setModel('Room');
    }

    /**
     * Gets an array of Room objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Flat is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Room[] List of Room objects
     * @throws PropelException
     */
    public function getRooms($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRoomsPartial && !$this->isNew();
        if (null === $this->collRooms || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRooms) {
                // return empty collection
                $this->initRooms();
            } else {
                $collRooms = RoomQuery::create(null, $criteria)
                    ->filterByFlat($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRoomsPartial && count($collRooms)) {
                      $this->initRooms(false);

                      foreach($collRooms as $obj) {
                        if (false == $this->collRooms->contains($obj)) {
                          $this->collRooms->append($obj);
                        }
                      }

                      $this->collRoomsPartial = true;
                    }

                    $collRooms->getInternalIterator()->rewind();
                    return $collRooms;
                }

                if($partial && $this->collRooms) {
                    foreach($this->collRooms as $obj) {
                        if($obj->isNew()) {
                            $collRooms[] = $obj;
                        }
                    }
                }

                $this->collRooms = $collRooms;
                $this->collRoomsPartial = false;
            }
        }

        return $this->collRooms;
    }

    /**
     * Sets a collection of Room objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rooms A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Flat The current object (for fluent API support)
     */
    public function setRooms(PropelCollection $rooms, PropelPDO $con = null)
    {
        $roomsToDelete = $this->getRooms(new Criteria(), $con)->diff($rooms);

        $this->roomsScheduledForDeletion = unserialize(serialize($roomsToDelete));

        foreach ($roomsToDelete as $roomRemoved) {
            $roomRemoved->setFlat(null);
        }

        $this->collRooms = null;
        foreach ($rooms as $room) {
            $this->addRoom($room);
        }

        $this->collRooms = $rooms;
        $this->collRoomsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Room objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Room objects.
     * @throws PropelException
     */
    public function countRooms(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRoomsPartial && !$this->isNew();
        if (null === $this->collRooms || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRooms) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRooms());
            }
            $query = RoomQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByFlat($this)
                ->count($con);
        }

        return count($this->collRooms);
    }

    /**
     * Method called to associate a Room object to this object
     * through the Room foreign key attribute.
     *
     * @param    Room $l Room
     * @return Flat The current object (for fluent API support)
     */
    public function addRoom(Room $l)
    {
        if ($this->collRooms === null) {
            $this->initRooms();
            $this->collRoomsPartial = true;
        }
        if (!in_array($l, $this->collRooms->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRoom($l);
        }

        return $this;
    }

    /**
     * @param	Room $room The room object to add.
     */
    protected function doAddRoom($room)
    {
        $this->collRooms[]= $room;
        $room->setFlat($this);
    }

    /**
     * @param	Room $room The room object to remove.
     * @return Flat The current object (for fluent API support)
     */
    public function removeRoom($room)
    {
        if ($this->getRooms()->contains($room)) {
            $this->collRooms->remove($this->collRooms->search($room));
            if (null === $this->roomsScheduledForDeletion) {
                $this->roomsScheduledForDeletion = clone $this->collRooms;
                $this->roomsScheduledForDeletion->clear();
            }
            $this->roomsScheduledForDeletion[]= $room;
            $room->setFlat(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->description = null;
        $this->country = null;
        $this->city = null;
        $this->postcode = null;
        $this->street = null;
        $this->number = null;
        $this->floor = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collRooms) {
                foreach ($this->collRooms as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collRooms instanceof PropelCollection) {
            $this->collRooms->clearIterator();
        }
        $this->collRooms = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(FlatPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
