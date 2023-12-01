<?php
require_once './vendor/autoload.php';

use AdventOfCode2023\Day1\Trebuchet;

$trebuchet = new Trebuchet('day1.txt');
echo $trebuchet->getCallibrationNumber() . PHP_EOL;
