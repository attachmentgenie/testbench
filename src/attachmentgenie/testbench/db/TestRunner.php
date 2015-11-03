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

namespace attachmentgenie\testbench\db;

use attachmentgenie\testbench\Check;
use Colors\Color;
use PHP_Timer;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
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
    public function __construct($config)
    {
        if (file_exists($config)) {
            $this->config = realpath($config);
        } elseif (file_exists($config . '.dist')) {
            $this->config = realpath($config . '.dist');
        } elseif (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $config)) {
            $this->config = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.$config);
        }
    }

    /**
     * Read configuration file, and run check.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        if (is_null($this->config)) {
            exit("Can not find a set of checks to run.\n");
        }

        PHP_Timer::start();
        $command = new \PHPUnit_TextUI_Command();
        $command->run(array('--configuration', $this->config, '--testdox'), false);
        $duration = PHP_Timer::stop();

        $c = new Color();
        echo $c('Time : ' . PHP_Timer::secondsToTimeString($duration))->bold() . PHP_EOL;
    }
}
