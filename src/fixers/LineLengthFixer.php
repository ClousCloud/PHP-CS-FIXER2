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
        return preg_replace_callback('/^.{'.($this->maxLength + 1).',}$/m', function ($matches) {
            return wordwrap($matches[0], $this->maxLength);
        }, $content);
    }

    public function getDescription(): string
    {
        return "Breaks long lines to a maximum of {$this->maxLength} characters.";
    }
}
