<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class MultiplyTest extends BaseNumberSuite
{

    public function multiplyValueProvider()
    {
        return [
            [0, 0, 0],
            [0, 0, 7],
            [49, 7, 7],
            [-49, -7, 7],
        ];
    }

    /**
     * Check that a number is multiplied correctly
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @param number $multiply The number to multiply
     * @dataProvider multiplyValueProvider
     * @covers ::multiply
     */
    public function testExpectedResults($expected, $number, $multiply)
    {
        $this->assertEquals($expected, $this->utility($number)->multiply($multiply)->value());
    }
}
