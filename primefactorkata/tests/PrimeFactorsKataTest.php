<?php
namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\PrimeFactorsKata;
use PHPUnit\Framework\TestCase;

class PrimeFactorsKataTest extends TestCase
{
    /**
     * @test
     */
    public function when_2_given_returns_2()
    {
        $primeFactorsKata = new PrimeFactorsKata();
        $factors = $primeFactorsKata->getFactors(2);
        $this->assertEquals([2], $factors);
    }
}
