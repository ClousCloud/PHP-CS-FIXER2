<?php

namespace phpcodestyle\fixers\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use phpcodestyle\FixerManager;

class FixCommand extends Command
{
    protected static $defaultName = 'fix';

    protected function configure() : void
    {
        $this
            ->setDescription('Fix PHP code style.')
            ->addArgument('path', InputArgument::REQUIRED, 'The path to the PHP files.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = $input->getArgument('path');
        $manager = new FixerManager();
        $manager->fix($path);
        
        $output->writeln('Code style fixed.');
        return Command::SUCCESS;
    }
}
