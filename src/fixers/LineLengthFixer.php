<?php

namespace phpcodestyle\fixers;

class LineLengthFixer implements FixerInterface
{
    private int $maxLength;

    public function __construct(int $maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function fix(string $content): string
    {
        $result = preg_replace('/.{100}/', '$0' . PHP_EOL, $content);
        return $result !== null ? $result : $content;
    }

    public function getDescription(): string
    {
        return "Breaks long lines to a maximum of {$this->maxLength} characters.";
    }
}
