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

    private function computeGamePower(string $line): int
    {
        $cubeMaxNumbers = [
            self::RED_COLOR => 0,
            self::GREEN_COLOR => 0,
            self::BLUE_COLOR => 0
        ];

        foreach ($this->getMatches($line)[0] as $match) {
            [$extractedNumberOfCubes, $color] = explode(' ', $match);
            if (isset($cubeMaxNumbers[$color])) {
                $cubeMaxNumbers[$color] = max($cubeMaxNumbers[$color], (int) $extractedNumberOfCubes);
            }
        }

        return array_product($cubeMaxNumbers);
    }
}