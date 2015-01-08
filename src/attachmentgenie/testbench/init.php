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
        echo "Creating tests directory...";
        if (!file_exists(getcwd() . '/tests')) {
            mkdir(getcwd() . '/tests', 0777, true);
        }
        if (!file_exists(getcwd() . '/tests/testbench')) {
            mkdir(getcwd() . '/tests/testbench', 0777, true);
        }
        if (!file_exists(getcwd() . '/tests/testbench/TestTbT.php')) {
            copy(__DIR__ . '/files/TestTbT.php', getcwd() . '/tests/testbench/TestTbT.php');
        }
        echo "Done.\n";
        echo "Creating db-test.xml.dist...";
        if (!file_exists(getcwd() . '/db-test.xml.dist')) {
            copy(__DIR__ . '/files/db-test.xml.dist', getcwd() . '/db-test.xml.dist');
        }
        echo "Done.\n";
        echo "Creating php-mongo.json.dist...";
        if (!file_exists(getcwd() . '/php-mongo.json.dist')) {
            copy(__DIR__ . '/files/php-mongo.json.dist', getcwd() . '/php-mongo.json.dist');
        }
        echo "Done.\n";
        echo "Finished creating testbench layout...\n";
    }
}