<?php
/**
 * Create a basic testbench setup.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench;

use Colors\Color as CliColor;

/**
 * Create a basic testbench setup.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class Init
{
    /**
     * Create directories and files to start testbench.
     *
     * @param string $installDir  Directory to install testbench into.
     * @param string $templateDir Template directory to install from.
     *
     * @return void
     */
    public static function run($installDir, $templateDir)
    {
        $c = new CliColor();

        $dirs = array('tests' . DIRECTORY_SEPARATOR . 'testbench');
        foreach ($dirs as $dir) {
            echo $c('Creating ' . $dir . '...');
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
                echo $c('success')->green() . PHP_EOL;
            } else {
                echo $c('skipping')->bold()->yellow() . PHP_EOL;
            }
        }

        $files = array('tests' . DIRECTORY_SEPARATOR . 'testbench' . DIRECTORY_SEPARATOR . 'TestTbT.php',
                       'db-test.xml.dist',
                       'php-mongo.json.dist',
                       'php-mysql.json.dist');
        foreach ($files as $filename) {
            echo $c('Creating ' . $filename . '...');
            if (!file_exists($installDir . DIRECTORY_SEPARATOR . $filename)) {
                copy($templateDir . DIRECTORY_SEPARATOR . $filename, $installDir . DIRECTORY_SEPARATOR . $filename);
                echo $c('success')->green() . PHP_EOL;
            } else {
                echo $c('skipping')->bold()->yellow() . PHP_EOL;
            }
        }
        echo $c('Created testbench layout')->bold() . PHP_EOL;
    }
}
