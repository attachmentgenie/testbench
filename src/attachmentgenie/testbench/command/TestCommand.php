<?php

namespace attachmentgenie\testbench\command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;

/**
 * Example command for testing purposes.
 */
class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('db:test')
            ->setDescription('Run test scenarios')
            ->addArgument('config', InputArgument::OPTIONAL, 'PHPUnit config');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xml_config = $input->getArgument('config');
        if (is_null($xml_config)) {
            if (file_exists('phpunit.xml')) {
                $xml_config = realpath( 'phpunit.xml');
            } elseif (file_exists('phpunit.xml.dist')) {
                $xml_config = realpath('phpunit.xml.dist');
            }
        }

        $command = new \PHPUnit_TextUI_Command();
        $command->run(array('--configuration', $xml_config, '--stderr', '--testdox'), false);
    }
}
