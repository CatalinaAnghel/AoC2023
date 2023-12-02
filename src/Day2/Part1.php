<?php

namespace AdventOfCode2023\Day2;

use AdventOfCode2023\Helper\FileReader;

class Part1
{
    public const INPUT_FILE_PATH = 'day2/';
    public const GAME_RESULTS_PATTERN = '#(?:([0-9]+ {1}((blue)|(green)|(red)){1}))#';
    public const GAME_PATTERN = '#(Game [0-9]+\\: )#';

    public const RED_COLOR = 'red';
    public const GREEN_COLOR = 'green';
    public const BLUE_COLOR = 'blue';

    public function __construct(
        private string $fileName,
        private int $redCubesNumber,
        private int $blueCubesNumber,
        private int $greenCubesNumber
    ) {
    }


    public function solve(): int
    {
        $sum = 0;
        $content = $this->getFileContent();
        foreach ($content as $line) {
            if ($this->validateGame($line)) {
                $sum += $this->getGameNumber($line);
            }
        }
        return $sum;
    }

    /**
     * @return string[]
     */
    private function getFileContent(): array
    {
        $fileReader = new FileReader;
        return $fileReader->readLineByLine(self::INPUT_FILE_PATH . $this->fileName);
    }

    private function getGameNumber(string $line): int
    {
        $gameInfo = [];
        preg_match(self::GAME_PATTERN, $line, $gameInfo);
        return (int) str_replace(': ', '', str_replace('Game ', '', $gameInfo[0]));

    }

    private function validateGame(string $line): bool
    {
        $valid = false;
        preg_match_all(self::GAME_RESULTS_PATTERN, $line, $matches);
        foreach ($matches[0] as $match) {
            [$extractedNumberOfCubes, $color] = explode(' ', $match);
            switch ($color) {
                case self::RED_COLOR:
                    $valid = (int) $extractedNumberOfCubes <= $this->redCubesNumber;
                    break;
                case self::GREEN_COLOR:
                    $valid = (int) $extractedNumberOfCubes <= $this->greenCubesNumber;
                    break;
                case self::BLUE_COLOR:
                    $valid = (int) $extractedNumberOfCubes <= $this->blueCubesNumber;
                    break;
                default:
                    $valid = false;
            }

            if (!$valid) {
                break;
            }
        }
        return $valid;
    }
}