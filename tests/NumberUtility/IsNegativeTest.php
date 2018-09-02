<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass \Myerscode\Utilities\Numbers\Utility
 */
class IsNegativeTest extends BaseNumberSuite
{

    public function dataProvider()
    {
        return [
            'negative zero decimal' => [true, -0.123],
            'negative number' => [true, -123],
            'zero decimal' => [false, 0.123],
            'positive number' => [false, 123],
            'decimal' => [false, 123.123],
        ];
    }

    public function zeroProvider()
    {
        return [
            'minus zero' => [-0],
            'zero' => [0],
        ];
    }

    /**
     * Check that a number is correctly identified a negative number
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @dataProvider dataProvider
     * @covers ::isNegative
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->isNegative());
    }

    /**
     * Check that a IsZeroException is thrown if number is 0
     *
     * @dataProvider zeroProvider
     * @covers ::isNegative
     */
    public function testIsZeroExceptionIsThrownWithZeroValue($zero)
    {
        $this->expectException(IsZeroException::class);
        $this->utility($zero)->isNegative();
    }
}
