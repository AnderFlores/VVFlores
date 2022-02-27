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
        $delimiter = ',';
        if ($this->checkCustomDelimiter($numbers)) {
            $delimiter = $this->getCustomDelimiter($numbers);
            $numbers = $this->getNumbers($numbers);
        }
        $arrayNumbers = $this->splitNumbersByDelimiters($numbers, $delimiter);
        $this->checkNegatives($arrayNumbers);
        $result = 0;
        foreach ($arrayNumbers as $number) {
            $result += $number;
        }
        return $result;
    }

    private function checkCustomDelimiter(String $numbers): bool
    {
        return str_starts_with($numbers, "//");
    }

    private function getCustomDelimiter(String $numbersWithCustomDelimiter): String
    {
        return substr($numbersWithCustomDelimiter, 2, strpos($numbersWithCustomDelimiter, "\n") - 1);
    }

    private function splitNumbersByDelimiters(String $numbers, String $delimiters): array
    {
        return preg_split('/[' . $delimiters . '\n]/', $numbers);;
    }

    private function getNumbers(String $numbersWithCustomDelimiter): String
    {
        return substr($numbersWithCustomDelimiter, strpos($numbersWithCustomDelimiter, "\n") + 1);
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