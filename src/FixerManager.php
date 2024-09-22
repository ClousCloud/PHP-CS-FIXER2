<?php

namespace phpcodestyle;

use phpcodestyle\fixers\Fixers\FixerInterface;

class FixerManager
{
    private array $fixers;
    private array $config;

    public function __construct()
    {
        // Memuat konfigurasi dari file
        $this->config = require __DIR__ . '/../config/.php_cs_config';

        $this->fixers = [];

        // Daftarkan fixer sesuai dengan konfigurasi
        if ($this->config['rules']['indentation']) {
            $this->fixers[] = new Fixers\IndentationFixer();
        }
        if ($this->config['rules']['line_length']) {
            $this->fixers[] = new Fixers\LineLengthFixer($this->config['rules']['line_length']);
        }
    }

    public function fix(string $path)
    {
        $files = glob($path . '/*.php');
        foreach ($files as $file) {
            $content = file_get_contents($file);

            foreach ($this->fixers as $fixer) {
                $content = $fixer->fix($content);
            }

            file_put_contents($file, $content);
        }
    }
}
