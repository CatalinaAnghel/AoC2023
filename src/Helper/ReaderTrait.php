<?php

namespace AdventOfCode2023\Helper;

trait ReaderTrait
{
    /**
     * @return string[]
     */
    protected function getFileContent(): array
    {
        $fileReader = new FileReader;
        return $fileReader->readLineByLine(static::INPUT_FILE_PATH . $this->getFileName());
    }
}