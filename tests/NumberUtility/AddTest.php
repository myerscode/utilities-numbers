<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class AddTest extends BaseNumberSuite
{

    public function addValueProvider()
    {
        return [
            [10, 5, 5],
            [1.001, 1, 0.001],
            [0, 0, 0],
            [0, -1, 1],
        ];
    }

    /**
     * Check that a number is added correctly
     *
     * @param number $expected The value expected to be returned
     * @param number $number The value to pass to the utility
     * @param number $addition The number to add
     * @dataProvider addValueProvider
     * @covers ::add
     */
    public function testExpectedResults($expected, $number, $addition)
    {
        $this->assertEquals($expected, $this->utility($number)->add($addition)->value());
    }
}
