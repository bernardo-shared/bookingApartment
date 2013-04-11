<?php

namespace Tsp\AdminBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Tsp\AdminBundle\Model\Bed;
use Tsp\AdminBundle\Model\BedPeer;
use Tsp\AdminBundle\Model\BedQuery;
use Tsp\AdminBundle\Model\Booking;
use Tsp\AdminBundle\Model\Room;

/**
 * Base class that represents a query for the 'bed' table.
 *
 *
 *
 * @method BedQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BedQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method BedQuery orderByRoomId($order = Criteria::ASC) Order by the room_id column
 *
 * @method BedQuery groupById() Group by the id column
 * @method BedQuery groupByType() Group by the type column
 * @method BedQuery groupByRoomId() Group by the room_id column
 *
 * @method BedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BedQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method BedQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method BedQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method BedQuery leftJoinBooking($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booking relation
 * @method BedQuery rightJoinBooking($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booking relation
 * @method BedQuery innerJoinBooking($relationAlias = null) Adds a INNER JOIN clause to the query using the Booking relation
 *
 * @method Bed findOne(PropelPDO $con = null) Return the first Bed matching the query
 * @method Bed findOneOrCreate(PropelPDO $con = null) Return the first Bed matching the query, or a new Bed object populated from the query conditions when no match is found
 *
 * @method Bed findOneByType(int $type) Return the first Bed filtered by the type column
 * @method Bed findOneByRoomId(int $room_id) Return the first Bed filtered by the room_id column
 *
 * @method array findById(int $id) Return Bed objects filtered by the id column
 * @method array findByType(int $type) Return Bed objects filtered by the type column
 * @method array findByRoomId(int $room_id) Return Bed objects filtered by the room_id column
 *
 * @package    propel.generator.src.Tsp.AdminBundle.Model.om
 */
abstract class BaseBedQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBedQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Tsp\\AdminBundle\\Model\\Bed', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BedQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BedQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BedQuery) {
            return $criteria;
        }
        $query = new BedQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Bed|Bed[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BedPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Bed A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Bed A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `type`, `room_id` FROM `bed` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Bed();
            $obj->hydrate($row);
            BedPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Bed|Bed[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Bed[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BedPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BedPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BedPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BedPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BedPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BedQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_scalar($type)) {
            $type = BedPeer::getSqlValueForEnum(BedPeer::TYPE, $type);
        } elseif (is_array($type)) {
            $convertedValues = array();
            foreach ($type as $value) {
                $convertedValues[] = BedPeer::getSqlValueForEnum(BedPeer::TYPE, $value);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BedPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the room_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRoomId(1234); // WHERE room_id = 1234
     * $query->filterByRoomId(array(12, 34)); // WHERE room_id IN (12, 34)
     * $query->filterByRoomId(array('min' => 12)); // WHERE room_id >= 12
     * $query->filterByRoomId(array('max' => 12)); // WHERE room_id <= 12
     * </code>
     *
     * @see       filterByRoom()
     *
     * @param     mixed $roomId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function filterByRoomId($roomId = null, $comparison = null)
    {
        if (is_array($roomId)) {
            $useMinMax = false;
            if (isset($roomId['min'])) {
                $this->addUsingAlias(BedPeer::ROOM_ID, $roomId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($roomId['max'])) {
                $this->addUsingAlias(BedPeer::ROOM_ID, $roomId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BedPeer::ROOM_ID, $roomId, $comparison);
    }

    /**
     * Filter the query by a related Room object
     *
     * @param   Room|PropelObjectCollection $room The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BedQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRoom($room, $comparison = null)
    {
        if ($room instanceof Room) {
            return $this
                ->addUsingAlias(BedPeer::ROOM_ID, $room->getId(), $comparison);
        } elseif ($room instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BedPeer::ROOM_ID, $room->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRoom() only accepts arguments of type Room or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Room relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function joinRoom($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Room');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Room');
        }

        return $this;
    }

    /**
     * Use the Room relation Room object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Tsp\AdminBundle\Model\RoomQuery A secondary query class using the current class as primary query
     */
    public function useRoomQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Room', '\Tsp\AdminBundle\Model\RoomQuery');
    }

    /**
     * Filter the query by a related Booking object
     *
     * @param   Booking|PropelObjectCollection $booking  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BedQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBooking($booking, $comparison = null)
    {
        if ($booking instanceof Booking) {
            return $this
                ->addUsingAlias(BedPeer::ID, $booking->getBedId(), $comparison);
        } elseif ($booking instanceof PropelObjectCollection) {
            return $this
                ->useBookingQuery()
                ->filterByPrimaryKeys($booking->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooking() only accepts arguments of type Booking or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Booking relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function joinBooking($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Booking');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Booking');
        }

        return $this;
    }

    /**
     * Use the Booking relation Booking object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Tsp\AdminBundle\Model\BookingQuery A secondary query class using the current class as primary query
     */
    public function useBookingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBooking($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booking', '\Tsp\AdminBundle\Model\BookingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Bed $bed Object to remove from the list of results
     *
     * @return BedQuery The current query, for fluid interface
     */
    public function prune($bed = null)
    {
        if ($bed) {
            $this->addUsingAlias(BedPeer::ID, $bed->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
