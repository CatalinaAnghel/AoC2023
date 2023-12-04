<?php

namespace AdventOfCode2023\Day4;

use AdventOfCode2023\Helper\ReaderTrait;
use AdventOfCode2023\Helper\SolutionInterface;

abstract class AbstractSolution implements SolutionInterface
{
    use ReaderTrait;

    public const CARD_PATTERN = '~Card [0-9]+: ~';

    public const CARD_NUMBER_PATTERN = '~[0-9]+~';

    public const INPUT_FILE_PATH = 'day4/';

    public function __construct(
        private string $fileName
    ) {
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    protected function getWinningNumbers(string $card): array
    {
        $card = preg_replace(self::CARD_PATTERN, '', $card);
        [$winningNumbersString, $chosenNumbersString] = explode(' | ', $card);
        $winningNumbers = explode(' ', $winningNumbersString);
        $chosenNumbers = explode(' ', $chosenNumbersString);
        return array_intersect($winningNumbers, $chosenNumbers);
    }
}