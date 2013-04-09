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
use Tsp\BookingBundle\Model\Flat;
use Tsp\BookingBundle\Model\FlatPeer;
use Tsp\BookingBundle\Model\FlatQuery;
use Tsp\BookingBundle\Model\Room;

/**
 * Base class that represents a query for the 'flat' table.
 *
 *
 *
 * @method FlatQuery orderById($order = Criteria::ASC) Order by the id column
 * @method FlatQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method FlatQuery orderByCountry($order = Criteria::ASC) Order by the country column
 * @method FlatQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method FlatQuery orderByPostcode($order = Criteria::ASC) Order by the postcode column
 * @method FlatQuery orderByStreet($order = Criteria::ASC) Order by the street column
 * @method FlatQuery orderByNumber($order = Criteria::ASC) Order by the number column
 * @method FlatQuery orderByFloor($order = Criteria::ASC) Order by the floor column
 *
 * @method FlatQuery groupById() Group by the id column
 * @method FlatQuery groupByDescription() Group by the description column
 * @method FlatQuery groupByCountry() Group by the country column
 * @method FlatQuery groupByCity() Group by the city column
 * @method FlatQuery groupByPostcode() Group by the postcode column
 * @method FlatQuery groupByStreet() Group by the street column
 * @method FlatQuery groupByNumber() Group by the number column
 * @method FlatQuery groupByFloor() Group by the floor column
 *
 * @method FlatQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method FlatQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method FlatQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method FlatQuery leftJoinRoom($relationAlias = null) Adds a LEFT JOIN clause to the query using the Room relation
 * @method FlatQuery rightJoinRoom($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Room relation
 * @method FlatQuery innerJoinRoom($relationAlias = null) Adds a INNER JOIN clause to the query using the Room relation
 *
 * @method Flat findOne(PropelPDO $con = null) Return the first Flat matching the query
 * @method Flat findOneOrCreate(PropelPDO $con = null) Return the first Flat matching the query, or a new Flat object populated from the query conditions when no match is found
 *
 * @method Flat findOneByDescription(string $description) Return the first Flat filtered by the description column
 * @method Flat findOneByCountry(string $country) Return the first Flat filtered by the country column
 * @method Flat findOneByCity(string $city) Return the first Flat filtered by the city column
 * @method Flat findOneByPostcode(string $postcode) Return the first Flat filtered by the postcode column
 * @method Flat findOneByStreet(string $street) Return the first Flat filtered by the street column
 * @method Flat findOneByNumber(string $number) Return the first Flat filtered by the number column
 * @method Flat findOneByFloor(string $floor) Return the first Flat filtered by the floor column
 *
 * @method array findById(int $id) Return Flat objects filtered by the id column
 * @method array findByDescription(string $description) Return Flat objects filtered by the description column
 * @method array findByCountry(string $country) Return Flat objects filtered by the country column
 * @method array findByCity(string $city) Return Flat objects filtered by the city column
 * @method array findByPostcode(string $postcode) Return Flat objects filtered by the postcode column
 * @method array findByStreet(string $street) Return Flat objects filtered by the street column
 * @method array findByNumber(string $number) Return Flat objects filtered by the number column
 * @method array findByFloor(string $floor) Return Flat objects filtered by the floor column
 *
 * @package    propel.generator.src.Tsp.BookingBundle.Model.om
 */
abstract class BaseFlatQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseFlatQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = 'Tsp\\BookingBundle\\Model\\Flat', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new FlatQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   FlatQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return FlatQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof FlatQuery) {
            return $criteria;
        }
        $query = new FlatQuery();
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
     * @return   Flat|Flat[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FlatPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(FlatPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Flat A model object, or null if the key is not found
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
     * @return                 Flat A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `description`, `country`, `city`, `postcode`, `street`, `number`, `floor` FROM `flat` WHERE `id` = :p0';
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
            $obj = new Flat();
            $obj->hydrate($row);
            FlatPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Flat|Flat[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Flat[]|mixed the list of results, formatted by the current formatter
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
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FlatPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FlatPeer::ID, $keys, Criteria::IN);
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
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FlatPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FlatPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FlatPeer::ID, $id, $comparison);
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
     * @return FlatQuery The current query, for fluid interface
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

        return $this->addUsingAlias(FlatPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the country column
     *
     * Example usage:
     * <code>
     * $query->filterByCountry('fooValue');   // WHERE country = 'fooValue'
     * $query->filterByCountry('%fooValue%'); // WHERE country LIKE '%fooValue%'
     * </code>
     *
     * @param     string $country The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByCountry($country = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($country)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $country)) {
                $country = str_replace('*', '%', $country);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::COUNTRY, $country, $comparison);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%'); // WHERE city LIKE '%fooValue%'
     * </code>
     *
     * @param     string $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByCity($city = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($city)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $city)) {
                $city = str_replace('*', '%', $city);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::CITY, $city, $comparison);
    }

    /**
     * Filter the query on the postcode column
     *
     * Example usage:
     * <code>
     * $query->filterByPostcode('fooValue');   // WHERE postcode = 'fooValue'
     * $query->filterByPostcode('%fooValue%'); // WHERE postcode LIKE '%fooValue%'
     * </code>
     *
     * @param     string $postcode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByPostcode($postcode = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($postcode)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $postcode)) {
                $postcode = str_replace('*', '%', $postcode);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::POSTCODE, $postcode, $comparison);
    }

    /**
     * Filter the query on the street column
     *
     * Example usage:
     * <code>
     * $query->filterByStreet('fooValue');   // WHERE street = 'fooValue'
     * $query->filterByStreet('%fooValue%'); // WHERE street LIKE '%fooValue%'
     * </code>
     *
     * @param     string $street The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByStreet($street = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($street)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $street)) {
                $street = str_replace('*', '%', $street);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::STREET, $street, $comparison);
    }

    /**
     * Filter the query on the number column
     *
     * Example usage:
     * <code>
     * $query->filterByNumber('fooValue');   // WHERE number = 'fooValue'
     * $query->filterByNumber('%fooValue%'); // WHERE number LIKE '%fooValue%'
     * </code>
     *
     * @param     string $number The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByNumber($number = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($number)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $number)) {
                $number = str_replace('*', '%', $number);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::NUMBER, $number, $comparison);
    }

    /**
     * Filter the query on the floor column
     *
     * Example usage:
     * <code>
     * $query->filterByFloor('fooValue');   // WHERE floor = 'fooValue'
     * $query->filterByFloor('%fooValue%'); // WHERE floor LIKE '%fooValue%'
     * </code>
     *
     * @param     string $floor The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function filterByFloor($floor = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($floor)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $floor)) {
                $floor = str_replace('*', '%', $floor);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FlatPeer::FLOOR, $floor, $comparison);
    }

    /**
     * Filter the query by a related Room object
     *
     * @param   Room|PropelObjectCollection $room  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 FlatQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRoom($room, $comparison = null)
    {
        if ($room instanceof Room) {
            return $this
                ->addUsingAlias(FlatPeer::ID, $room->getFlatId(), $comparison);
        } elseif ($room instanceof PropelObjectCollection) {
            return $this
                ->useRoomQuery()
                ->filterByPrimaryKeys($room->getPrimaryKeys())
                ->endUse();
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
     * @return FlatQuery The current query, for fluid interface
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
     * @return   \Tsp\BookingBundle\Model\RoomQuery A secondary query class using the current class as primary query
     */
    public function useRoomQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRoom($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Room', '\Tsp\BookingBundle\Model\RoomQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Flat $flat Object to remove from the list of results
     *
     * @return FlatQuery The current query, for fluid interface
     */
    public function prune($flat = null)
    {
        if ($flat) {
            $this->addUsingAlias(FlatPeer::ID, $flat->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
