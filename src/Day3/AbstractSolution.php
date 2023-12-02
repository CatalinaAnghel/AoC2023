<?php

namespace AdventOfCode2023\Day3;
use AdventOfCode2023\Helper\ReaderTrait;
use AdventOfCode2023\Helper\SolutionInterface;

abstract class AbstractSolution implements SolutionInterface
{
    use ReaderTrait;

    public const INPUT_FILE_PATH = 'day3/';

    public function __construct(
        private string $fileName
    ){}

    public function getFileName(): string
    {
        return $this->fileName;
    }
}