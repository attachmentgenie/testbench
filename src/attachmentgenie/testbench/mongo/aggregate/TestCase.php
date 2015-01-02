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

    protected $dataset;

    /**
     * Return connection to mongo server.
     *
     * @return \MongoClient
     */
    public function getConnection() 
    {
        return new \MongoClient();
    }

    /**
     * Return mongo dataset.
     *
     * @return mixed
     */
    public function getDataSet() 
    {
        if (empty($this->datasetdataSet)) {
            $this->datasetdataSet = new DataSet($this->getConnection());
        }
        return $this->dataset;
    }
}