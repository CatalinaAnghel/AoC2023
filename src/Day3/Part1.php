<?php

namespace AdventOfCode2023\Day3;


class Part1 extends AbstractSolution
{
    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $content = $this->parseFileContent();
        return array_sum($this->filterPartNumbers($content));
    }

    /**
     * @return int[]
     */
    private function filterPartNumbers(array $content): array
    {
        $partNumbers = [];
        foreach ($content[self::PART_NUMBERS_KEY] as $possiblePartNumber) {
            $adjacentSymbols = $this->getAdjacentSymbol($content[self::SYMBOLS_KEY], $possiblePartNumber);
            if(count($adjacentSymbols)){
                $partNumbers[] = (int) $possiblePartNumber->value;
            }
        }
        return $partNumbers;
    }

    private function getAdjacentSymbol(array $symbols, ElementDto $elementDto): array
    {
        return array_filter($symbols, static function  (ElementDto $symbol, int $key) use ($elementDto) {
            $horizontallyAlligned = $elementDto->row === $symbol->row && (
                $elementDto->startPosition === $symbol->startPosition + 1 || 
                $elementDto->startPosition + strlen($elementDto->value) === $symbol->startPosition
            );
            $adjacentRows = ($elementDto->row === $symbol->row + 1) || ($elementDto->row === $symbol->row - 1);
            $verticallyAlligned = $adjacentRows && ($elementDto->startPosition <= $symbol->startPosition && 
            $elementDto->startPosition + strlen($elementDto->value) >= $symbol->startPosition);
            $diagonallyAlligned = $adjacentRows && (
                $symbol->startPosition === $elementDto->startPosition - 1 || 
                $symbol->startPosition === $elementDto->startPosition + strlen($elementDto->value)
            );

            return $horizontallyAlligned || $verticallyAlligned || $diagonallyAlligned;
        }, ARRAY_FILTER_USE_BOTH);
    }
}