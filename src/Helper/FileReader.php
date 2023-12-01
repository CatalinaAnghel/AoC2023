<?php

namespace AdventOfCode2023\Helper;

class FileReader
{
    private $path = './input/';

    public function __construct(){}

    public function read($filename){
        return file_get_contents($this->path . $filename);
    }

    public function readLineByLine($filename){
        $input = array();
        if ($file = fopen($this->path . $filename, "r")) {
            while(!feof($file)) {
                $content = trim(fgets($file));
                if(!empty($content)){
                    $input[] = preg_replace('# +#', ' ', $content);
                }
            }
            fclose($file);
        }

        return $input;
    }
}