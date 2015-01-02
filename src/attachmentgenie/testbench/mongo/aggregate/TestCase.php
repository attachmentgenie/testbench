<?php
/**
 * Simple test framework.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmententgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\mongo\aggregate;

use Zumba\PHPUnit\Extensions\Mongo\DataSet\DataSet;
use Zumba\PHPUnit\Extensions\Mongo\TestCase as MongoTestCase;
use Zumba\PHPUnit\Extensions\Mongo\Client\Connector;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmententgenie.com>
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
     * @return \Zumba\PHPUnit\Extensions\Mongo\Client\Connector
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
     * @return mixed
     */
    public function getDataSet()
    {
        if (empty($this->dataset)) {
            $this->dataSet = new DataSet($this->getConnection());
        }
        return $this->dataset;
    }
}
