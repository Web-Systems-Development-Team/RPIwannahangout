<?php

namespace Base;

use \EventInterest as ChildEventInterest;
use \EventInterestQuery as ChildEventInterestQuery;
use \Exception;
use \PDO;
use Map\EventInterestTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'event_interest' table.
 *
 *
 *
 * @method     ChildEventInterestQuery orderByEventInterestId($order = Criteria::ASC) Order by the event_interest_id column
 * @method     ChildEventInterestQuery orderByBringingCar($order = Criteria::ASC) Order by the bringing_car column
 * @method     ChildEventInterestQuery orderByInterestedUserId($order = Criteria::ASC) Order by the interested_user_id column
 *
 * @method     ChildEventInterestQuery groupByEventInterestId() Group by the event_interest_id column
 * @method     ChildEventInterestQuery groupByBringingCar() Group by the bringing_car column
 * @method     ChildEventInterestQuery groupByInterestedUserId() Group by the interested_user_id column
 *
 * @method     ChildEventInterestQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEventInterestQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEventInterestQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEventInterestQuery leftJoinInterested($relationAlias = null) Adds a LEFT JOIN clause to the query using the Interested relation
 * @method     ChildEventInterestQuery rightJoinInterested($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Interested relation
 * @method     ChildEventInterestQuery innerJoinInterested($relationAlias = null) Adds a INNER JOIN clause to the query using the Interested relation
 *
 * @method     \UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEventInterest findOne(ConnectionInterface $con = null) Return the first ChildEventInterest matching the query
 * @method     ChildEventInterest findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEventInterest matching the query, or a new ChildEventInterest object populated from the query conditions when no match is found
 *
 * @method     ChildEventInterest findOneByEventInterestId(int $event_interest_id) Return the first ChildEventInterest filtered by the event_interest_id column
 * @method     ChildEventInterest findOneByBringingCar(boolean $bringing_car) Return the first ChildEventInterest filtered by the bringing_car column
 * @method     ChildEventInterest findOneByInterestedUserId(int $interested_user_id) Return the first ChildEventInterest filtered by the interested_user_id column
 *
 * @method     ChildEventInterest[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEventInterest objects based on current ModelCriteria
 * @method     ChildEventInterest[]|ObjectCollection findByEventInterestId(int $event_interest_id) Return ChildEventInterest objects filtered by the event_interest_id column
 * @method     ChildEventInterest[]|ObjectCollection findByBringingCar(boolean $bringing_car) Return ChildEventInterest objects filtered by the bringing_car column
 * @method     ChildEventInterest[]|ObjectCollection findByInterestedUserId(int $interested_user_id) Return ChildEventInterest objects filtered by the interested_user_id column
 * @method     ChildEventInterest[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EventInterestQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \Base\EventInterestQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RPIWannaHangOut', $modelName = '\\EventInterest', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEventInterestQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEventInterestQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEventInterestQuery) {
            return $criteria;
        }
        $query = new ChildEventInterestQuery();
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
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEventInterest|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EventInterestTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EventInterestTableMap::DATABASE_NAME);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventInterest A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT event_interest_id, bringing_car, interested_user_id FROM event_interest WHERE event_interest_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEventInterest $obj */
            $obj = new ChildEventInterest();
            $obj->hydrate($row);
            EventInterestTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildEventInterest|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the event_interest_id column
     *
     * Example usage:
     * <code>
     * $query->filterByEventInterestId(1234); // WHERE event_interest_id = 1234
     * $query->filterByEventInterestId(array(12, 34)); // WHERE event_interest_id IN (12, 34)
     * $query->filterByEventInterestId(array('min' => 12)); // WHERE event_interest_id > 12
     * </code>
     *
     * @param     mixed $eventInterestId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByEventInterestId($eventInterestId = null, $comparison = null)
    {
        if (is_array($eventInterestId)) {
            $useMinMax = false;
            if (isset($eventInterestId['min'])) {
                $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $eventInterestId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eventInterestId['max'])) {
                $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $eventInterestId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $eventInterestId, $comparison);
    }

    /**
     * Filter the query on the bringing_car column
     *
     * Example usage:
     * <code>
     * $query->filterByBringingCar(true); // WHERE bringing_car = true
     * $query->filterByBringingCar('yes'); // WHERE bringing_car = true
     * </code>
     *
     * @param     boolean|string $bringingCar The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByBringingCar($bringingCar = null, $comparison = null)
    {
        if (is_string($bringingCar)) {
            $bringingCar = in_array(strtolower($bringingCar), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(EventInterestTableMap::COL_BRINGING_CAR, $bringingCar, $comparison);
    }

    /**
     * Filter the query on the interested_user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByInterestedUserId(1234); // WHERE interested_user_id = 1234
     * $query->filterByInterestedUserId(array(12, 34)); // WHERE interested_user_id IN (12, 34)
     * $query->filterByInterestedUserId(array('min' => 12)); // WHERE interested_user_id > 12
     * </code>
     *
     * @see       filterByInterested()
     *
     * @param     mixed $interestedUserId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByInterestedUserId($interestedUserId = null, $comparison = null)
    {
        if (is_array($interestedUserId)) {
            $useMinMax = false;
            if (isset($interestedUserId['min'])) {
                $this->addUsingAlias(EventInterestTableMap::COL_INTERESTED_USER_ID, $interestedUserId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($interestedUserId['max'])) {
                $this->addUsingAlias(EventInterestTableMap::COL_INTERESTED_USER_ID, $interestedUserId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EventInterestTableMap::COL_INTERESTED_USER_ID, $interestedUserId, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEventInterestQuery The current query, for fluid interface
     */
    public function filterByInterested($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(EventInterestTableMap::COL_INTERESTED_USER_ID, $user->getUserId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EventInterestTableMap::COL_INTERESTED_USER_ID, $user->toKeyValue('PrimaryKey', 'UserId'), $comparison);
        } else {
            throw new PropelException('filterByInterested() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Interested relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function joinInterested($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Interested');

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
            $this->addJoinObject($join, 'Interested');
        }

        return $this;
    }

    /**
     * Use the Interested relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useInterestedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinInterested($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Interested', '\UserQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEventInterest $eventInterest Object to remove from the list of results
     *
     * @return $this|ChildEventInterestQuery The current query, for fluid interface
     */
    public function prune($eventInterest = null)
    {
        if ($eventInterest) {
            $this->addUsingAlias(EventInterestTableMap::COL_EVENT_INTEREST_ID, $eventInterest->getEventInterestId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the event_interest table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventInterestTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EventInterestTableMap::clearInstancePool();
            EventInterestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EventInterestTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EventInterestTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EventInterestTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EventInterestTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EventInterestQuery
