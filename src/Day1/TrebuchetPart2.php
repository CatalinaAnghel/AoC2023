<?php

namespace AdventOfCode2023\Day1;

use AdventOfCode2023\Helper\FileReader;

class TrebuchetPart2
{
    public const INPUT_FILE_PATH = 'day1/';
    private const MAPPING_ARRAY = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9
    ];

    public function __construct(private string $fileName)
    {
    }

    public function getCallibrationNumber(): int
    {
        $callibrationNumbers = [];
        $content = $this->getFileContent();
        foreach ($content as $lineNumber => $line) {
            $matches = [];
            preg_match_all('#(?=([0-9]|(one)|(two)|(three)|(four)|(five)|(six)|(seven)|(eight)|(nine)))#', $line, $matches);
            $foundStrings = [];
            foreach ($matches as $match) {
                if(!in_array("", $match)){
                    foreach ($match as $elem) {
                        if (!empty($elem)) {
                            $foundStrings[] = $elem;
                        }
                    }
                }
                
            }
            $firstDigit = $lastDigit = 0;
            if (in_array($foundStrings[0], array_keys(self::MAPPING_ARRAY), true)) {
                $firstDigit = (string)self::MAPPING_ARRAY[$foundStrings[0]];
            } else {
                $firstDigit = substr((string)$foundStrings[0], 0, 1);
            }
            if (in_array(end($foundStrings), array_keys(self::MAPPING_ARRAY), true)) {
                $lastDigit = (string)self::MAPPING_ARRAY[end($foundStrings)];
            } else {
                $lastDigit = substr(end($foundStrings), -1);
            }
            $callibrationNumbers[] = (int)($firstDigit . $lastDigit);
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