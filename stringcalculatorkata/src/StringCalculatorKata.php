<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculatorKata
{
    public function add(String $numbers): String
    {
        if (empty($numbers)) {
            return "0";
        }
        if (strpos($numbers, "\n") != -1) {
            $numbers = str_replace("\n", ",", $numbers);
        }
        $array = explode(",", $numbers);
        $result = 0;
        for ($i = 0; $i < sizeof($array); $i++) {
            $result += $array[$i];
        }
        return $result;
    }
}