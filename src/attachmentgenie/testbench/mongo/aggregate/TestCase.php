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

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
class TestCase extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * Placeholder warning
     *
     * @return void
     */
    public function testMongoAggregateTestCaseHasNotBeenImplementedYet()
    {
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    protected function getConnection()
    {

    }

    protected function getDataSet()
    {

    }
}
