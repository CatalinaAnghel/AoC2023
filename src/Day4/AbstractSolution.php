<?php

namespace AdventOfCode2023\Day4;
use AdventOfCode2023\Helper\ReaderTrait;
use AdventOfCode2023\Helper\SolutionInterface;

abstract class AbstractSolution implements SolutionInterface
{
    use ReaderTrait;

    public const INPUT_FILE_PATH = 'day4/';

    public function __construct(
        private string $fileName
    ){}

    public function getFileName(): string
    {
        return $this->fileName;
    }
}