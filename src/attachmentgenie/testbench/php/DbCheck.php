<?php
/**
 * Abstra
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\php;

use Prereq\PrereqChecker;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
abstract class DbCheck
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
        if (file_exists(getcwd() . DIRECTORY_SEPARATOR . $config)) {
            $this->config = realpath(getcwd() . DIRECTORY_SEPARATOR . $config);
        } elseif (file_exists(getcwd() . DIRECTORY_SEPARATOR . $config . '.dist')) {
            $this->config = realpath(getcwd() . DIRECTORY_SEPARATOR . $config . '.dist');
        } elseif (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $config)) {
            $this->config = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.$config);
        } else {
            exit("Can not find a set of checks to run.\n");
        }
    }

    /**
     * Read configuration file, and run check.
     *
     * @return null|boolean
     * @throws \Exception
     */
    public function run()
    {
        $pc = new PrereqChecker();

        $string = file_get_contents($this->config);
        $json   =json_decode($string, true);
        foreach ($json as $section => $entries) {
            switch ($section) {
                case 'registerCheck':
                    foreach ($entries as $name => $className) {
                        $pc->registerCheck($name, $className);
                    }
                    break;
                case 'checkMandatory':
                case 'checkOptional':
                    foreach ($entries as $check) {
                        call_user_func_array(array(&$pc, $section), $check);
                    }
                    break;
                default:
                    exit('Unknown section found in config file : ' . $section . "\n");
            }
        }

        return $pc->didAllSucceed();
    }
}
