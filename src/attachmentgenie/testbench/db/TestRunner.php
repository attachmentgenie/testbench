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

namespace attachmentgenie\testbench\db;

use attachmentgenie\testbench\Check;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class TestRunner implements Check
{
    /**
     * Config file where parameters are defined.
     *
     * @var null|string
     */
    protected $config = null;

    /**
     * Figure out where the defined config file is or degrade gracefully.
     *
     * @param string $config Configuration file
     */
    function __construct($config)
    {
        if (file_exists($config)) {
            $this->config = realpath($config);
        } elseif (file_exists($config . '.dist')) {
            $this->config = realpath($config . '.dist');
        } elseif (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $config)) {
            $this->config = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.$config);
        } else {
            exit("Can not find a set of checks to run.\n");
        }
    }

    /**
     * Read configuration file, and run check.
     *
     * @return boolean|null
     * @throws \Exception
     */
    public function run()
    {

        $command = new \PHPUnit_TextUI_Command();
        $command->run(array('--configuration', $this->config, '--testdox'), false);
    }
}
