<?php
/**
 * Simple test framework.
 *
 * PHP version 5
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use attachmentgenie\testbench\Test;
use attachmentgenie\testbench\php\MongoCheck;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class MongoPhpCommand extends Command
{
    /**
     * Setup cli entry to run mongo php checks.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('mongo:php')
            ->setDescription('Check if PHP has been setup for use with mongo')
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
            $config = 'php-mongo.json.dist';
        }

        if (Test::check(new MongoCheck($config))) {
            echo "All tests succeeded!\n";
        } else {
            echo "Some tests failed. Please check.\n";
        }
    }
}
