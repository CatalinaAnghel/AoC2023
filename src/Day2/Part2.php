<?php

namespace AdventOfCode2023\Day2;

use AdventOfCode2023\Helper\FileReader;

class Part2 extends AbstractSolution
{
    public function solve(): int
    {
        $sum = 0;
        $content = $this->getFileContent();
        foreach ($content as $line) {
            $sum += $this->computeGamePower($line);
        }
        return $sum;
    }

    /**
     * @return string[]
     */
    private function getFileContent(): array
    {
        $fileReader = new FileReader;
        return $fileReader->readLineByLine(self::INPUT_FILE_PATH . $this->getFileName());
    }

    private function computeGamePower(string $line): int
    {
        $maxNumberOfRedCubes = 0;
        $maxNumberOfGreenCubes = 0;
        $maxNumberOfBlueCubes = 0;
        
        foreach ($this->getMatches($line)[0] as $match) {
            [$extractedNumberOfCubes, $color] = explode(' ', $match);
            switch ($color) {
                case self::RED_COLOR:
                    if ((int) $extractedNumberOfCubes > $maxNumberOfRedCubes) {
                        $maxNumberOfRedCubes = (int) $extractedNumberOfCubes;
                    }
                    break;
                case self::GREEN_COLOR:
                    if ((int) $extractedNumberOfCubes > $maxNumberOfGreenCubes) {
                        $maxNumberOfGreenCubes = (int) $extractedNumberOfCubes;
                    }
                    break;
                case self::BLUE_COLOR:
                    if ((int) $extractedNumberOfCubes > $maxNumberOfBlueCubes) {
                        $maxNumberOfBlueCubes = (int) $extractedNumberOfCubes;
                    }
                    break;
            }
        }
        return $maxNumberOfBlueCubes * $maxNumberOfRedCubes * $maxNumberOfGreenCubes;
    }
}