<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class MagnitudeTest extends BaseNumberSuite
{
    public function dataProvider()
    {
        return [
            [0, 0],
            [1, 11.235523],
            [-5, -0.000011235523],
            [13, -12315639128398.232],
            [3, 1000],
            [2, 999.999999],
            [-2, 0.01],
        ];
    }

    /**
     * Test utility returns correct order of magnitude
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     *
     * @dataProvider dataProvider
     * @covers ::magnitude
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->magnitude()->value());
    }
}