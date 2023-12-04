<?php

namespace AdventOfCode2023\Day4;

class Part2 extends AbstractSolution
{
    public function __construct(
        string $fileName
    ) {
        parent::__construct($fileName);
    }


    public function solve(): int
    {
        $cards = [];
        $content = $this->getFileContent();
        $numberOfCards = count($content);
        foreach ($content as $key => $card) {
            $cards[$key + 1] = isset($cards[$key + 1])? $cards[$key + 1] + 1: 1;
            $commonNumbers = $this->getWinningNumbers($card);
            $numberOfWonCards = count($commonNumbers);
            if ($numberOfWonCards) {
                for($cardIterator = $key + 2; $cardIterator <= min([$numberOfCards, $key + $numberOfWonCards]) + 1; $cardIterator++){
                    $cards[$cardIterator] = isset($cards[$cardIterator])? 
                    $cards[$cardIterator] + $cards[$key + 1]: 
                    $cards[$key + 1];
                }
            }
        }

        return array_sum($cards);
    }
}