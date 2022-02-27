<?php

namespace Deg540\PHPTestingBoilerplate;

use PHPUnit\Util\Exception;

class StringCalculatorKata
{
    public function add(String $numbers): String
    {
        if (empty($numbers)) {
            return "0";
        }
        $arrayNumbers = preg_split('/[,|\n]/', $numbers);
        $this->checkNegatives($arrayNumbers);
        $result = 0;
        for ($i = 0; $i < sizeof($arrayNumbers); $i++) {
            $result += $arrayNumbers[$i];
        }
        return $result;
    }

    private function checkNegatives(array $arrayNumbers): void
    {
        $negativeNumbers = "";
        foreach ($arrayNumbers as $number) {
            if ($number < 0) {
                $negativeNumbers .= $number . ", ";
            }
        }
        if (!empty($negativeNumbers)) {
            $negativeNumbers = substr($negativeNumbers, 0, strlen($negativeNumbers) - 2);
            throw new Exception("Negative not allowed : " . $negativeNumbers);
        }
    }
}