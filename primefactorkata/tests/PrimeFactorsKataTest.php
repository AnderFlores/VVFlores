<?php
namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\PrimeFactorsKata;
use PHPUnit\Framework\TestCase;

class PrimeFactorsKataTest extends TestCase
{
    /*
 * @var
 */
    private PrimeFactorsKata $primeFactorsKata;

    /*
     * @setup
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->primeFactorsKata = new PrimeFactorsKata();
    }
    /**
     * @test
     */
    public function when_1_given_returns_empty()
    {
        $factors = $this->primeFactorsKata->getFactors(1);
        $this->assertEmpty($factors);
    }
    /**
     * @test
     */
    public function when_2_given_returns_2()
    {
        $factors = $this->primeFactorsKata->getFactors(2);
        $this->assertEquals([2], $factors);
    }
}