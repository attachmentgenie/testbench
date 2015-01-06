<?php
/**
 * Create a basic testbench setup.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench;

use attachmentgenie\testbench\Check;

/**
 * Create a basic testbench setup.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class init
{
    /**
     * Create directories and files to start testbench.
     */
    static function run ()
    {
        echo "Creating testbench layout...\n";
        echo "Creating tests directory...\n";
        if (!file_exists('tests')) {
            mkdir(getcwd() . '/tests', 0777, true);
        }
        echo "Done...\n";
        echo "Creating db-test.xml.dist...\n";
        if (!file_exists('db-test.xml.dist')) {
            copy(__DIR__ . '/files/db-test.xml.dist', getcwd() . '/db-test.xml.dist');
        }
        echo "Done...\n";
        echo "Creating php-mongo.json.dist...\n";
        if (!file_exists('php-mongo.json.dist')) {
            copy(__DIR__ . '/files/php-mongo.json.dist', getcwd() . '/php-mongo.json.dist');
        }
        echo "Done...\n";
        echo "Done creating testbench layout...\n";
    }
}