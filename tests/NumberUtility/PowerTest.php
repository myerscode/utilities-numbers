<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class PowerTest extends BaseNumberSuite
{
    public function dataProvider()
    {
        return [
            [0, 0, 9],
            [1, 1, -10],
            [16, 2, 4],
            [1, 3, 0],
            [125, 5, 3],
            [823543, 7, 7],
        ];
    }

    /**
     * Test utility can multiply the number by an exponent correctly
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     *
     * @dataProvider dataProvider
     * @covers ::power
     */
    public function testExpectedResults($expected, $number, $exponent)
    {
        $this->assertEquals($expected, $this->utility($number)->power($exponent)->value());
    }
}