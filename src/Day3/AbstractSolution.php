<?php

namespace AdventOfCode2023\Day3;
use AdventOfCode2023\Helper\ReaderTrait;
use AdventOfCode2023\Helper\SolutionInterface;

abstract class AbstractSolution implements SolutionInterface
{
    use ReaderTrait;

    public const INPUT_FILE_PATH = 'day3/';
    public const IGNORED_SYMBOL = '.';

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
            'partNumbers' => [],
            'symbols' => []
        ];
        $content = $this->getFileContent();
        foreach ($content as $lineNumber => $line) {
            $matches = [];
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
}