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

namespace attachmentgenie\testbench\mongo\query;

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

    /**
     * Make sure the query is actually using a index.
     *
     * @return void
     */
    public function testCursorIsBtreeCursor()
    {
        $this->assertStringStartsWith('BtreeCursor', $this->explain['cursor']);
    }

    /**
     * Make sure the entire result set is covered by the index
     *
     * @return void
     */
    public function testQueryIsIndexOnly()
    {
        $this->assertTrue($this->explain['indexOnly']);
    }

    /**
     * Multikey indexes currently have some issues.
     *
     * @return void
     */
    public function testQueryIsNotUsingAMultiKey()
    {
        $this->assertFalse($this->explain['isMultiKey']);
    }

    /**
     * The mongo manual suggest that queries should return in under 100ms.
     *
     * @return void
     */
    public function testQueryRunsInUnder100ms()
    {
        $this->assertLessThanOrEqual(100, $this->explain['millis']);
    }

    /**
     * A good index should return the same N of objects  as N of scanned objects.
     *
     * @return void
     */
    public function testObjectsScannedEqualsObjectsReturned()
    {
        $this->assertEquals($this->explain['n'], $this->explain['nscannedObjects']);
    }
}
