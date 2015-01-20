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

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    use \Zumba\PHPUnit\Extensions\Mongo\TestTrait;

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
    public function getMongoConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new Connector(new \MongoClient());
            $this->connection->setDb(static::DEFAULT_DATABASE);
        }
        return $this->connection;
    }

    /**
     * Return mongo dataset.
     *
     * @return DataSet
     */
    public function getMongoDataSet()
    {
        if (empty($this->dataSet)) {
            $this->dataSet = new DataSet($this->getMongoConnection());
            $this->dataSet->setFixture($this->fixture);
        }
        return $this->dataSet;
    }
}
