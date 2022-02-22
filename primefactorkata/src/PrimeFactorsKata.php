<?php

namespace Deg540\PHPTestingBoilerplate;

class PrimeFactorsKata
{
    public function getFactors(int $number): array
    {
        $factors = [];
        for ($i = 0, $divider = 2; $number > 1; $divider++)
        {
            for (; $number % $divider == 0; $number /= $divider, $i++)
            {
                $factors[$i] = $divider;
            }
        }
        return $factors;
    }
}