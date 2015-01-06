<?php
/**
 * Simple test framework.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\mongo\aggregate;

use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;
use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;
use Zumba\PHPUnit\Extensions\Mongo\TestCase as MongoTestCase;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class TestCase extends MongoTestCase
{
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
    protected $dataset;

    /**
     * Return connection to mongo server.
     *
     * @return Connector
     */
    public function getConnection()
    {
        if (empty($this->connection)) {
            $this->connection = new Connector(new \MongoClient());
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
        if (empty($this->dataset)) {
            $this->dataset = new DataSet($this->getConnection());
        }
        return $this->dataset;
    }
}
