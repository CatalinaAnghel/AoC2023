<?php

namespace AdventOfCode2023\Day2;

abstract class AbstractSolution
{
    public const INPUT_FILE_PATH = 'day2/';
    public const GAME_RESULTS_PATTERN = '#(?:([0-9]+ {1}((blue)|(green)|(red)){1}))#';
    public const GAME_PATTERN = '#(Game [0-9]+\\: )#';

    public const RED_COLOR = 'red';
    public const GREEN_COLOR = 'green';
    public const BLUE_COLOR = 'blue';

    public function __construct(
        private string $fileName
    ) {
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    protected function getMatches(string $line): array
    {
        preg_match_all(self::GAME_RESULTS_PATTERN, $line, $matches);

        return $matches;
    }

    abstract public function solve(): int;
}