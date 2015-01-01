<?php

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Example command for testing purposes.
 */
class MongoPhpCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('mongo:php')
            ->setDescription('Check if PHP has been setup for use with mongo');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pc = new \Prereq\PrereqChecker();
        $pc->checkMandatory('php_version','>=','5.3.0');
        $pc->checkMandatory('php_extension','mongo');

        if ($pc->didAllSucceed()) {
            echo "All tests succeeded!\n";
        } else {
            echo "Some tests failed. Please check.\n";
        }
    }
}
