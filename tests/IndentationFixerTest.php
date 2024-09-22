<?php

use PHPUnit\Framework\TestCase;
use phpcodestyle\fixers\IndentationFixer;

class IndentationFixerTest extends TestCase
{
    public function testFix() : void
    {
        $fixer = new IndentationFixer();
        $content = "    function test() {}\n    function anotherTest() {}";
        $expected = "\tfunction test() {}\n\tfunction anotherTest() {}";

        $this->assertEquals($expected, $fixer->fix($content));
    }
}
