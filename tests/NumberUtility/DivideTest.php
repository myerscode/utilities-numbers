<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class DivideTest extends BaseNumberSuite
{

    public function divideValueProvider()
    {
        return [
            [1, 7, 7],
            [7, 49, 7],
        ];
    }

    public function zeroExceptionValueProvider()
    {
        return [
            [0, 7],
            [7, 0],
        ];
    }

    /**
     * Check that a number is divided correctly
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @param number $division The number to divide by
     * @dataProvider divideValueProvider
     * @covers ::divide
     */
    public function testExpectedResults($expected, $number, $division)
    {
        $this->assertEquals($expected, $this->utility($number)->divide($division)->value());
    }

    /**
     * Check that a exception is thrown with zeros
     *
     * @param number $number The value to pass to the utility
     * @param number $division The number to divide by
     * @dataProvider zeroExceptionValueProvider
     * @expectedException \DivisionByZeroError
     * @covers ::divide
     */
    public function testExceptionResults($number, $division)
    {
        $this->utility($number)->divide($division)->value();
    }
}
