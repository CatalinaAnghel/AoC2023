<?php

namespace AdventOfCode2023\Day3;


class Part1 extends AbstractSolution
{
    public const IGNORED_SYMBOL = '.';

    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $content = $this->getFileContent();
        return array_sum($this->filterPartNumbers($content));
    }

    protected function getFileContent(): array
    {
        $parsedContent = [
            'partNumbers' => [],
            'symbols' => []
        ];
        $content = parent::getFileContent();
        foreach ($content as $lineNumber => $line) {
            $matches = [];
            $numberOfCharacters = strlen($line);
            preg_match_all('~(?:[^\\.\\d\\s]|([0-9]+))~', $line, $matches, PREG_OFFSET_CAPTURE);
            foreach ($matches[0] as $match) {
                if(!empty($match[0])){
                    $key = is_numeric($match[0]) ? 'partNumbers' : 'symbols';
                    $parsedContent[$key][] = new ElementDto(
                        $match[0],
                        $lineNumber,
                        $match[1]
                    );
                }
            }
        }
        return $parsedContent;
    }

    /**
     * @return int[]
     */
    private function filterPartNumbers(array $content): array
    {
        $partNumbers = [];
        foreach ($content['partNumbers'] as $possiblePartNumber) {
            $adjacentSymbols = $this->getAdjacentSymbol($content['symbols'], $possiblePartNumber);
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