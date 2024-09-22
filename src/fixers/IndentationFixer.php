<?php

namespace phpcodestyle\fixers;

class IndentationFixer implements FixerInterface
{
    public function fix(string $content): string
    {
        // Mengganti 4 spasi menjadi tab
        return preg_replace('/^ {4}/m', "\t", $content);
    }

    public function getDescription(): string
    {
        return "Converts 4 spaces to tabs.";
    }
}
