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
        $errors = "";
        $delimiter = ',';
        if ($this->checkCustomDelimiter($numbersToSum)) {
            $delimiter = $this->getCustomDelimiter($numbersToSum);
            $numbersToSum = $this->getNumbers($numbersToSum);
        }
        try {
            $this->checkEndOfNumbers($numbersToSum, $delimiter);
        } catch (Exception $ex) {
            $errors .= $ex->getMessage() . "\n";
        }
        $this->checkConsecutiveDelimiters($numbersToSum, $delimiter);
        $arrayNumbers = $this->splitNumbersByDelimiters($numbersToSum, $delimiter);
        try {
            $this->checkNegatives($arrayNumbers);
        } catch (Exception $ex) {
            $errors .= $ex->getMessage() . "\n";
        }
        $result = 0;
        foreach ($arrayNumbers as $number) {
            if (!empty($number)) {
                if (!is_numeric($number)) {
                    try {
                        $this->hasInvalidDelimiter($number, $numbersToSum, $delimiter);
                    } catch (Exception $ex) {
                        $errors .= $ex->getMessage() . "\n";
                    }
                } else {
                    $result += $number;
                }
            }
        }
        if (!empty($errors)) {
            $this->throwErrors($errors);
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

    private function checkEndOfNumbers(String $numbersToSum, String $delimiter): void
    {
        if (str_ends_with($numbersToSum, $delimiter)) {
            throw new Exception("Number expected but EOF found");
        }
    }

    private function checkConsecutiveDelimiters(String $numbersToSum, String $delimiter): void
    {
        if (str_contains($numbersToSum, $delimiter . $delimiter)) {
            $posConsecutiveDelimiter = strpos($numbersToSum, $delimiter . $delimiter) + 1;
            throw new Exception("Number expected but '" . $delimiter . "' found at position " . $posConsecutiveDelimiter);
        } elseif (str_contains($numbersToSum, "\n" . $delimiter)) {
            $posConsecutiveDelimiter = strpos($numbersToSum, "\n" . $delimiter) + 1;
            throw new Exception("Number expected but '" . $delimiter . "' found at position " . $posConsecutiveDelimiter);
        } elseif (str_contains($numbersToSum, "\n\n")) {
            $posConsecutiveDelimiter = strpos($numbersToSum, "\n\n") + 1;
            throw new Exception("Number expected but '\n' found at position " . $posConsecutiveDelimiter);
        } elseif (str_contains($numbersToSum, $delimiter . "\n")) {
            $posConsecutiveDelimiter = strpos($numbersToSum, $delimiter . "\n") + 1;
            throw new Exception("Number expected but '\n' found at position " . $posConsecutiveDelimiter);
        }
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

    private function hasInvalidDelimiter($number, $numbersToSum, $delimiter): void
    {
        $invalidDelimiter = preg_replace("/[0-9.]/", "", $number);
        $posInvalidDelimiter = strpos($numbersToSum, $invalidDelimiter);
        throw new Exception("'" . $delimiter . "' expected but '" . $invalidDelimiter . "' found at position " . $posInvalidDelimiter);
    }

    private function throwErrors($errors): void
    {
        $errors = substr($errors, 0, strlen($errors) - 1);
        throw new Exception($errors);
    }
}