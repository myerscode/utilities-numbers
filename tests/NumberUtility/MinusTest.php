<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class MinusTest extends BaseNumberSuite
{

    public function minusValueProvider()
    {
        return [
            [0, 5, 5],
            [0.999, 1, 0.001],
            [0, 0, 0],
            [-2, -1, 1],
            [2, 1, -1],
        ];
    }

    /**
     * Check that a number is subtracted correctly
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @param number $minus The number to add
     * @dataProvider minusValueProvider
     * @covers ::minus
     */
    public function testExpectedResults($expected, $number, $minus)
    {
        $this->assertEquals($expected, $this->utility($number)->minus($minus)->value());
    }
}
