<?php

namespace phpcodestyle;

use phpcodestyle\fixers\FixerInterface;

class FixerManager
{
    /** @var FixerInterface[] */
    private array $fixers;

    /** @var array<string, mixed> */
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/.php_cs_config';

        $this->fixers = [];

        if ($this->config['rules']['indentation']) {
            $this->fixers[] = new fixers\IndentationFixer();
        }

        if ($this->config['rules']['line_length']) {
            $this->fixers[] = new fixers\LineLengthFixer($this->config['rules']['line_length']);
        }
    }

    public function fix(string $path): void
{
    $files = glob($path . '/*.php');
    if ($files === false) {
        return;
    }

    foreach ($files as $file) {
        $content = file_get_contents($file);
        if ($content === false) {
            continue;
        }

        foreach ($this->fixers as $fixer) {
            $content = $fixer->fix($content);
        }

        file_put_contents($file, $content);
    }
}

}
