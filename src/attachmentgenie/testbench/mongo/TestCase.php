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
abstract class TestCase extends \PHPUnit_Framework_TestCase
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
     * Setup the colllection, indexes and run the explain query.
     *
     * @return void
     */
    public function setUp()
    {
        $this->setFixture($this->getFixtures());
        $this->mongoSetUp();
        $this->setIndexes($this->getIndexes());
        $this->setExplain();
    }

    /**
     * Make dataset available to test setup.
     *
     * @param $fixtures Mongo dataset
     *
     * @return void
     */
    public function setFixture($fixtures)
    {
        $this->fixture = $fixtures;
    }

    /**
     * Obtain the dataset as specified by the programmer.
     *
     * @return array
     */
    abstract public function getFixtures();

    /**
     * Make indexes available to test setup.
     *
     * @param $fixtures Mongo indexes
     *
     * @return void
     */
    public function setIndexes($fixtures)
    {
        foreach ($fixtures as $collection => $indexes) {
            foreach ($indexes as $index) {
                $this->getMongoConnection()->collection($collection)->ensureIndex($index);
            }
        }
    }

    /**
     * Obtain the indexes as specified by the programmer.
     *
     * @return array
     */
    abstract public function getIndexes();

    /**
     * Explain query output
     *
     * @return array
     */
    abstract public function setExplain();

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
