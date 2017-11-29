<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class PadLeftTest extends BaseNumberSuite
{

    public function _valueProvider()
    {
        return [
            [001, 3, 1],
            [1, 0, 1],
        ];
    }

    /**
     * Pad a number left
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @dataProvider _valueProvider
     * @covers ::padLeft
     */
    public function testExpectedResults($expected, $pad, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->padLeft($pad));
    }
}
