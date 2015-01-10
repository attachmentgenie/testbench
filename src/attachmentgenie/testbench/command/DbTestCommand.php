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

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use attachmentgenie\testbench\Test;
use attachmentgenie\testbench\db\TestRunner;

/**
 * Simple test framework.
 *
 * @category Attachmentgenie
 * @package  Testbench
 * @author   Bram Vogelaar <bram@attachmentgenie.com>
 * @license  https://github.com/attachmentgenie/testbench/LICENSE.md MIT
 * @link     https://github.com/attachmentgenie/testbench
 */
class DbTestCommand extends Command
{
    /**
     * Setup cli entry to run db tests.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('db:test')
            ->setDescription('Run test scenarios')
            ->addArgument('config', InputArgument::OPTIONAL, 'PHPUnit config');
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
        $config = $input->getArgument('config');
        if (is_null($config)) {
            $config = 'db-test.xml.dist';
        }

        Test::check(new TestRunner($config));
    }
}
