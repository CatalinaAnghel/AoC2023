<?php

namespace AdventOfCode2023\Day3;


class Part2 extends AbstractSolution
{
    public const GEAR_SYMBOL = '*';

    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $content = $this->parseFileContent();
        return array_sum($this->getGearRatios($content));
    }

    /**
     * @return int[]
     */
    private function getGearRatios(array $content): array
    {
        $gearRatios = [];
        $gears = array_filter($content[self::SYMBOLS_KEY], static function (ElementDto $symbol, int $key){
            return $symbol->value === self::GEAR_SYMBOL;
        }, ARRAY_FILTER_USE_BOTH);
        foreach ($gears as $gear) {
            $adjacentNumbers = $this->getAdjacentNumber($content[self::PART_NUMBERS_KEY], $gear);
            $gearRatio = 1;
            if(count($adjacentNumbers) > 1){
                foreach ($adjacentNumbers as $number){
                    $gearRatio *= (int)$number->value;
                }
                $gearRatios[] = $gearRatio;
            }
        }
        return $gearRatios;
    }

    private function getAdjacentNumber(array $numbers, ElementDto $symbol): array
    {
        return array_filter($numbers, static function  (ElementDto $number, int $key) use ($symbol) {
            $horizontallyAlligned = $number->row === $symbol->row && (
                $number->startPosition === $symbol->startPosition + 1 || 
                $number->startPosition + strlen($number->value) === $symbol->startPosition
            );
            $adjacentRows = ($number->row === $symbol->row + 1) || ($number->row === $symbol->row - 1);
            $verticallyAlligned = $adjacentRows && ($number->startPosition <= $symbol->startPosition && 
            $number->startPosition + strlen($number->value) >= $symbol->startPosition);
            $diagonallyAlligned = $adjacentRows && (
                $symbol->startPosition === $number->startPosition - 1 || 
                $symbol->startPosition === $number->startPosition + strlen($number->value)
            );

            return $horizontallyAlligned || $verticallyAlligned || $diagonallyAlligned;
        }, ARRAY_FILTER_USE_BOTH);
    }
}