<?php

namespace AdventOfCode2023\Day4;

class Part1 extends AbstractSolution
{
    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $points = 0;
        $content = $this->getFileContent();
        foreach($content as $card){
            $card = preg_replace(self::CARD_PATTERN, '', $card);
            [$winningNumbersString, $chosenNumbersString] = explode(' | ', $card);
            $winningNumbers = explode(' ', $winningNumbersString);
            $chosenNumbers = explode(' ', $chosenNumbersString);
            $commonNumbers = array_intersect($winningNumbers, $chosenNumbers);
            if(!empty($commonNumbers)){
                $points += pow(2, count($commonNumbers) - 1);
            }
        }
        return $points;
    }
}