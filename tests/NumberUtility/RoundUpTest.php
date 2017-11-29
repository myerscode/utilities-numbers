<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class RoundUpTest extends BaseNumberSuite
{

    public function roundUpValueProvider()
    {
        return [
            [4, 4.3],
            [5, 4.5],
            [10, 9.999],
            [-3, -3.14],
            [0, 0],
            [0, 0.00000000001],
        ];
    }

    public function roundUpPrecisionValueProvider()
    {
        return [
            [4, 4.2345, 0],
            [4.2, 4.2345, 1],
            [4.23, 4.2345, 2],
            [4.235, 4.2345, 3],
            [4.2345, 4.2345, 4],
            [4.2345, 4.2345, 6],
        ];
    }

    /**
     * Check the type of the number
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider roundUpValueProvider
     * @covers ::roundUp
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp()->value());
    }

    /**
     * Check the number is rounded up with precision
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @param string $precision The precision to goto for rounding up
     * @dataProvider roundUpPrecisionValueProvider
     * @covers ::roundUp
     */
    public function testPrecisionExpectedResults($expected, $number, $precision)
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp($precision)->value());
    }

    /**
     * Check when rounded up with invalid value a InvalidNumberException exception is thrown
     *
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException
     * @covers ::roundUp
     */
    public function testExpectedInvalidPrecision()
    {
        $this->utility(12.3456)->roundUp(-1)->value();
    }
}
