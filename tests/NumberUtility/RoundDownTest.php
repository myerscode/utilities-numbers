<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class RoundDownTest extends BaseNumberSuite
{

    public function roundDownValueProvider()
    {
        return [
            [4, 4.3],
            [10, 9.999],
            [-3, -3.14],
            [0, 0],
            [0, 0.00000000001],
        ];
    }

    public function roundDownPrecisionValueProvider()
    {
        return [
            [4, 4.2345, 0],
            [4.2, 4.2345, 1],
            [4.23, 4.2345, 2],
            [4.234, 4.2345, 3],
            [4.2345, 4.2345, 4],
            [4.2345, 4.2345, 6],
        ];
    }

    /**
     * Check that the number is rounded down correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider roundDownValueProvider
     * @covers ::roundDown
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown()->value());
    }

    /**
     * Check the number is rounded down with precision
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @param string $precision The precision to goto for rounding up
     * @dataProvider roundDownPrecisionValueProvider
     * @covers ::roundDown
     */
    public function testPrecisionExpectedResults($expected, $number, $precision)
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown($precision)->value());
    }

    /**
     * Check the number is rounded down with precision
     *
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException
     * @covers ::roundDown
     */
    public function testExpectedInvalidPrecision()
    {
        $this->utility(12.3456)->roundDown(-1)->value();
    }
}
