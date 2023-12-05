<?php

namespace AdventOfCode2023\Day5;

class Part1 extends AbstractSolution
{
    private array $seeds = [];
    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $parsedContent = $this->parseContent();
        $locations = [];

        foreach ($this->seeds as $seed) {
            $searchedKey = (int)$seed;
            foreach (array_keys($parsedContent) as $map) {
                $search = array_values(array_filter($parsedContent[$map], static function($value) use ($searchedKey){
                    return $value['sourceStart'] <= (int)$searchedKey && (int)$searchedKey < $value['sourceEnd'];
                }))[0]?? null;
                $searchedKey = null!== $search? $search['destinationStart'] + $searchedKey - $search['sourceStart'] : (int) $searchedKey;
                
            }
            $locations[] = $searchedKey;
        }
        return min($locations);
    }

    public function parseContent(): array
    {
        $parsedContent = [];
        $almanach = $this->getFileContent();
        $element = '';
        foreach ($almanach as $key => $line) {
            if (0 === $key) {
                [$element, $seedsString] = explode(': ', $line);
                $this->seeds = explode(' ', $seedsString);
            } elseif (preg_match('~.+ map:~', $line)) {
                $element = str_replace(' map:', '', str_replace('-to', '', $line));
                $parsedContent[$element] = [];
            } elseif (!empty($line)) {
                [$destinationRangeStart, $sourceRangeStart, $rangeLength] = explode(' ', $line);
                $parsedContent[$element][] = [
                    'sourceStart' => (int)$sourceRangeStart,
                    'sourceEnd' => (int)$sourceRangeStart + (int)$rangeLength,
                    'destinationStart' => (int)$destinationRangeStart,
                    'destinationEnd' => (int)$destinationRangeStart + (int)$rangeLength
                ];
            }
        }
        return $parsedContent;
    }
}