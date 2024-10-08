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
        parent::__construct();
        
        $this->fixerManager = $fixerManager;
    }

    protected function configure(): void
    {
        $this
            ->setName('fix')
            ->setDescription('Fix PHP code style.')
            ->addArgument('path', InputArgument::REQUIRED, 'The path to the PHP files.', 'string');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $path = $input->getArgument('path');

        if (!is_string($path)) {
            throw new \InvalidArgumentException('Path must be a string.');
        }

        $this->fixerManager->fix($path);

        $output->writeln("<info>PHP code style fixed successfully.</info>");

        return Command::SUCCESS;
    }
}
