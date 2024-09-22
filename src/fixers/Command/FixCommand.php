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

public function execute(InputInterface $input, OutputInterface $output): int
{
    $path = $input->getArgument('path');
    
    // Pastikan $path adalah string sebelum memanggil fix()
    if (!is_string($path)) {
        throw new \InvalidArgumentException('Path harus berupa string.');
    }

    $this->fixerManager->fix($path);
    
    return Command::SUCCESS;
}
}
