<?php

require_once './vendor/autoload.php';

use AdventOfCode2023\Day2\Part1;

$part1 = new Part1('input.txt', 12, 14, 13);

echo $part1->solve() . PHP_EOL;
