<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class PadRightTest extends BaseNumberSuite
{

    public function _valueProvider()
    {
        return [
            [100, 3, 1],
            [1, 0, 1],
        ];
    }

    /**
     * Pad a number to the right
     *
     * @param number $expected The value expected to be returned
     * @param number $pad Amount to pad the value by
     * @param number $number The value to pass to the utility
     * @dataProvider _valueProvider
     * @covers ::padRight
     */
    public function testExpectedResults($expected, $pad, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->padRight($pad));
    }
}
