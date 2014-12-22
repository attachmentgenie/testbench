<?php

namespace inuits\dbperf\command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Example command for testing purposes.
 */
class MongoRunCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('mongo:run')
            ->setDescription('Get Application Information');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // This is a contrived example to show accessing services
        // from the container without needing the command itself
        // to extend from anything but Symfony Console's base Command.

        $app = $this->getApplication()->getService('console');

        $output->writeln('Name: ' . $app->getName());
        $output->writeln('Version: ' . $app->getVersion());
    }
}
