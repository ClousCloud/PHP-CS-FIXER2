<?php

namespace phpcodestyle\fixers;

class IndentationFixer implements FixerInterface
{
    public function fix(string $content): string
    {
        $result = preg_replace('/^ {4}/m', "\t", $content);
        return $result !== null ? $result : $content;
    }


    public function getDescription(): string
    {
        return "Converts 4 spaces to tabs.";
    }
}
