<?php

namespace Tsp\BookingBundle\Model\om;

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
use Tsp\BookingBundle\Model\Bed;
use Tsp\BookingBundle\Model\Flat;
use Tsp\BookingBundle\Model\Room;
use Tsp\BookingBundle\Model\RoomPeer;
use Tsp\BookingBundle\Model\RoomQuery;

/**
 * Base class that represents a query for the 'room' table.
 *
 *
 *
 * @method RoomQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RoomQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method RoomQuery orderByFlatId($order = Criteria::ASC) Order by the flat_id column
 *
 * @method RoomQuery groupById() Group by the id column
 * @method RoomQuery groupByDescription() Group by the description column
 * @method RoomQuery groupByFlatId() Group by the flat_id column
 *
 * @method RoomQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RoomQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RoomQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RoomQuery leftJoinFlat($relationAlias = null) Adds a LEFT JOIN clause to the query using the Flat relation
 * @method RoomQuery rightJoinFlat($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Flat relation
 * @method RoomQuery innerJoinFlat($relationAlias = null) Adds a INNER JOIN clause to the query using the Flat relation
 *
 * @method RoomQuery leftJoinBed($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bed relation
 * @method RoomQuery rightJoinBed($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bed relation
 * @method RoomQuery innerJoinBed($relationAlias = null) Adds a INNER JOIN clause to the query using the Bed relation
 *
 * @method Room findOne(PropelPDO $con = null) Return the first Room matching the query
 * @method Room findOneOrCreate(PropelPDO $con = null) Return the first Room matching the query, or a new Room object populated from the query conditions when no match is found
 *
 * @method Room findOneByDescription(string $description) Return the first Room filtered by the description column
 * @method Room findOneByFlatId(int $flat_id) Return the first Room filtered by the flat_id column
 *
 * @method array findById(int $id) Return Room objects filtered by the id column
 * @method array findByDescription(string $description) Return Room objects filtered by the description column
 * @method array findByFlatId(int $flat_id) Return Room objects filtered by the flat_id column
 *
 * @package    propel.generator.src.Tsp.BookingBundle.Model.om
 */
abstract class BaseRoomQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRoomQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Tsp\\BookingBundle\\Model\\Room', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RoomQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RoomQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RoomQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RoomQuery) {
            return $criteria;
        }
        $query = new RoomQuery();
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
     * @return   Room|Room[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RoomPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RoomPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Room A model object, or null if the key is not found
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
     * @return                 Room A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `description`, `flat_id` FROM `room` WHERE `id` = :p0';
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
            $obj = new Room();
            $obj->hydrate($row);
            RoomPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Room|Room[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Room[]|mixed the list of results, formatted by the current formatter
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
     * @return RoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RoomPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RoomPeer::ID, $keys, Criteria::IN);
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
     * @return RoomQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RoomPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RoomPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RoomPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the flat_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFlatId(1234); // WHERE flat_id = 1234
     * $query->filterByFlatId(array(12, 34)); // WHERE flat_id IN (12, 34)
     * $query->filterByFlatId(array('min' => 12)); // WHERE flat_id >= 12
     * $query->filterByFlatId(array('max' => 12)); // WHERE flat_id <= 12
     * </code>
     *
     * @see       filterByFlat()
     *
     * @param     mixed $flatId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function filterByFlatId($flatId = null, $comparison = null)
    {
        if (is_array($flatId)) {
            $useMinMax = false;
            if (isset($flatId['min'])) {
                $this->addUsingAlias(RoomPeer::FLAT_ID, $flatId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($flatId['max'])) {
                $this->addUsingAlias(RoomPeer::FLAT_ID, $flatId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RoomPeer::FLAT_ID, $flatId, $comparison);
    }

    /**
     * Filter the query by a related Flat object
     *
     * @param   Flat|PropelObjectCollection $flat The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RoomQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByFlat($flat, $comparison = null)
    {
        if ($flat instanceof Flat) {
            return $this
                ->addUsingAlias(RoomPeer::FLAT_ID, $flat->getId(), $comparison);
        } elseif ($flat instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RoomPeer::FLAT_ID, $flat->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByFlat() only accepts arguments of type Flat or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Flat relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function joinFlat($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Flat');

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
            $this->addJoinObject($join, 'Flat');
        }

        return $this;
    }

    /**
     * Use the Flat relation Flat object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Tsp\BookingBundle\Model\FlatQuery A secondary query class using the current class as primary query
     */
    public function useFlatQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFlat($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Flat', '\Tsp\BookingBundle\Model\FlatQuery');
    }

    /**
     * Filter the query by a related Bed object
     *
     * @param   Bed|PropelObjectCollection $bed  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RoomQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBed($bed, $comparison = null)
    {
        if ($bed instanceof Bed) {
            return $this
                ->addUsingAlias(RoomPeer::ID, $bed->getRoomId(), $comparison);
        } elseif ($bed instanceof PropelObjectCollection) {
            return $this
                ->useBedQuery()
                ->filterByPrimaryKeys($bed->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBed() only accepts arguments of type Bed or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bed relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function joinBed($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bed');

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
            $this->addJoinObject($join, 'Bed');
        }

        return $this;
    }

    /**
     * Use the Bed relation Bed object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Tsp\BookingBundle\Model\BedQuery A secondary query class using the current class as primary query
     */
    public function useBedQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBed($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bed', '\Tsp\BookingBundle\Model\BedQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Room $room Object to remove from the list of results
     *
     * @return RoomQuery The current query, for fluid interface
     */
    public function prune($room = null)
    {
        if ($room) {
            $this->addUsingAlias(RoomPeer::ID, $room->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
