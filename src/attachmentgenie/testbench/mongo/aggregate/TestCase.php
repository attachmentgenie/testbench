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

namespace attachmentgenie\testbench\mongo\aggregate;

use attachmentgenie\testbench\mongo\TestCase as MongoTestCase;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
abstract class TestCase extends MongoTestCase
{
    use \Zumba\PHPUnit\Extensions\Mongo\TestTrait;
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
}
