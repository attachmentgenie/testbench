<?php
/**
 * Simple test framework.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE MIT
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use attachmentgenie\testbench\Test;
use attachmentgenie\testbench\php\MySQLCheck;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
class PhpMySQLCommand extends Command
{
    /**
     * Setup cli entry to run mongo php checks.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('php:mysql')
            ->setDescription('Check if PHP has been setup for use with mysql')
            ->addArgument('config', InputArgument::OPTIONAL, 'checks to run');
    }

    /**
     * Run the mongo:php check
     *
     * @param InputInterface  $input  CLI input
     * @param OutputInterface $output CLI output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $input->getArgument('config');
        if (is_null($config)) {
            $config = 'php-mysql.json.dist';
        }

        if (Test::check(new MySQLCheck($config))) {
            echo "All tests succeeded!\n";
        } else {
            echo "Some tests failed. Please check.\n";
        }
    }
}
