<?php

namespace Deg540\PHPTestingBoilerplate;

use PHPUnit\Util\Exception;

class StringCalculatorKata
{
    public function add(String $numbersToSum): String
    {
        if (empty($numbersToSum)) {
            return "0";
        }
        $delimiter = ',';
        if ($this->checkCustomDelimiter($numbersToSum)) {
            $delimiter = $this->getCustomDelimiter($numbersToSum);
            $numbersToSum = $this->getNumbers($numbersToSum);
        }
        if (str_ends_with($numbersToSum, $delimiter)) {
            throw new Exception("Number expected but EOF found");
        }
        $arrayNumbers = $this->splitNumbersByDelimiters($numbersToSum, $delimiter);
        $this->checkNegatives($arrayNumbers);
        $result = 0;
        foreach ($arrayNumbers as $number) {
            if (!is_numeric($number)) {
                $nonNumericCharacter = preg_replace("/[0-9.]/", "", $number);
                $posNonNumericCharacter = strpos($numbersToSum, $nonNumericCharacter);
                throw new Exception("'" . $delimiter . "' expected but '" . $nonNumericCharacter . "' found at position " . $posNonNumericCharacter);
            } else {
                $result += $number;
            }
        }
        return $result;
    }

    private function checkCustomDelimiter(String $numbers): bool
    {
        return str_starts_with($numbers, "//");
    }

    private function getCustomDelimiter(String $numbersWithCustomDelimiter): String
    {
        return substr($numbersWithCustomDelimiter, 2, strpos($numbersWithCustomDelimiter, "\n") - 2);
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
            if (is_numeric($number)) {
                if ($number < 0) {
                    $negativeNumbers .= $number . ", ";
                }
            }
        }
        if (!empty($negativeNumbers)) {
            $negativeNumbers = substr($negativeNumbers, 0, strlen($negativeNumbers) - 2);
            throw new Exception("Negative not allowed : " . $negativeNumbers);
        }
    }
}