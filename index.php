<?php

require_once './vendor/autoload.php';

use AdventOfCode2023\Day1\TrebuchetPart2;


$trebuchet = new TrebuchetPart2('day1.txt');
echo $trebuchet->getCallibrationNumber() . PHP_EOL;
