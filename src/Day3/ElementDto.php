<?php

namespace AdventOfCode2023\Day3;

class ElementDto
{
    public function __construct(
        public string $value,
        public int $row,
        public int $startPosition
    ) {
    }
}