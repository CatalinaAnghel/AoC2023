<?php

namespace AdventOfCode2023\Day3;
use AdventOfCode2023\Helper\ReaderTrait;
use AdventOfCode2023\Helper\SolutionInterface;

abstract class AbstractSolution implements SolutionInterface
{
    use ReaderTrait;

    public const INPUT_FILE_PATH = 'day3/';
    public const IGNORED_SYMBOL = '.';
    public const PART_NUMBERS_KEY = 'partNumbers';
    public const SYMBOLS_KEY = 'symbols';
    public const GEAR_PATTERN = '~(?:[^\\.\\d\\s]|([0-9]+))~';

    public function __construct(
        private string $fileName
    ){}

    public function getFileName(): string
    {
        return $this->fileName;
    }

    protected function parseFileContent(): array
    {
        $parsedContent = [
            self::PART_NUMBERS_KEY => [],
            self::SYMBOLS_KEY => []
        ];
        $content = $this->getFileContent();
        foreach ($content as $lineNumber => $line) {
            $matches = [];
            preg_match_all(self::GEAR_PATTERN, $line, $matches, PREG_OFFSET_CAPTURE);
            foreach ($matches[0] as $match) {
                if(!empty($match[0])){
                    $key = is_numeric($match[0]) ? self::PART_NUMBERS_KEY : self::SYMBOLS_KEY;
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
}