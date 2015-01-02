<?php
/**
 * Abstra
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmententgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\php;

use Prereq\PrereqChecker;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmententgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
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
     * @return bool
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