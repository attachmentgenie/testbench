<?php
/**
 * Simple test framework.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\mongo;

use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;
use Zumba\PHPUnit\Extensions\Mongo\TestCase as MongoTestCase;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
class TestCase extends MongoTestCase
{
    const DEFAULT_DATABASE = 'testbench';

    /**
     * Mongo connection.
     *
     * @var Connector
     */
    protected $connection;

    /**
     * Mongo dataset.
     *
     * @var DataSet
     */
    protected $dataSet;

    /**
     * Result of explain query
     *
     * @var array
     */
    protected $explain;

    /**
     * Sample dataset to query
     *
     * @var array
     */
    protected $fixture;

    /**
     * Return connection to mongo server.
     *
     * @return Connector
     */
    public function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new \Zumba\PHPUnit\Extensions\Mongo\Client\Connector(new \MongoClient());
            $this->connection->setDb(static::DEFAULT_DATABASE);
        }
        return $this->connection;
    }

    /**
     * Return mongo dataset.
     *
     * @return DataSet
     */
    public function getDataSet()
    {
        if (empty($this->dataSet)) {
            $this->dataSet = new \Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet($this->getConnection());
            $this->dataSet->setFixture($this->fixture);
        }
        return $this->dataSet;
    }
}
