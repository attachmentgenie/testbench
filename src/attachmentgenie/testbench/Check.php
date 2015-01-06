<?php
/**
 * Simple interface to define a check.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench;

/**
 * Simple interface to define a check.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
interface Check
{

    /**
     * Test the defined parameters.
     *
     * @return boolean|null
     */
    public function run();
}
