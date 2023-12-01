<?php

namespace AdventOfCode2023\Day1;

use AdventOfCode2023\Helper\FileReader;

class Trebuchet
{
    public const INPUT_FILE_PATH = 'day1/';

    public function __construct(private string $fileName){}

    public function getCallibrationNumber(): int
    {
        $callibrationNumbers = [];
        $content = $this->getFileContent();
        foreach ($content as $line) {
            preg_match_all('#[0-9]+#', $line, $matches);
            $firstDigit = $lastDigit = 0;
            foreach ($matches as $match) {
                $firstDigit = (int) substr($match[0], 0, 1);
                $lastDigit = ((int) end($match)) % 10;
                $callibrationNumbers[] = 10 * $firstDigit + $lastDigit;
            }
        }

        return array_sum($callibrationNumbers);
    }

    /**
     * @return string[]
     */
    private function getFileContent(): array
    {
        $fileReader = new FileReader;
        return $fileReader->readLineByLine(self::INPUT_FILE_PATH . $this->fileName);
    }
}