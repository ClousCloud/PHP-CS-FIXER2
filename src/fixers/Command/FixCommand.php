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
    private FixerManager $fixerManager;

    public function __construct(FixerManager $fixerManager)
    {
        $this->fixerManager = $fixerManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Fix PHP code style.')
            ->addArgument('path', InputArgument::REQUIRED, 'The path to the PHP files.', 'string')
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');

        // Validate the path before proceeding
        if (!is_string($path) || !file_exists($path)) {
            $output->writeln("<error>Invalid path: {$path}</error>");
            return Command::FAILURE;
        }

        $this->fixerManager->fix($path);

        $output->writeln("<info>PHP code style fixed successfully.</info>");

        return Command::SUCCESS;
    }
}
