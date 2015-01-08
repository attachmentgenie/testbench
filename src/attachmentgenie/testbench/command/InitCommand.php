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

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use attachmentgenie\testbench\Init;
use attachmentgenie\testbench\Test;
use attachmentgenie\testbench\db\TestRunner;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE Apache 2.0
 * @link     https://github.com/attachmentgenie/testbench
 */
class InitCommand extends Command
{
    /**
     * Setup cli entry to run db tests.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('testbench:init')
            ->setDescription('Create basic testbench setup');
    }

    /**
     * Run the db:test check
     *
     * @param InputInterface  $input  CLI input
     * @param OutputInterface $output CLI output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Init::run(getcwd(), __DIR__ . DIRECTORY_SEPARATOR . 'files');
    }
}
