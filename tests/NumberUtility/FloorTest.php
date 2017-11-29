<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class FloorTest extends BaseNumberSuite
{

    public function floorValueProvider()
    {
        return [
            [4, 4.3],
            [9, 9.999],
            [-4, -3.14],
            [0, 0],
            [0, 0.00000000001],
        ];
    }

    /**
     * Check the number is rounded down correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider floorValueProvider
     * @covers ::floor
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->floor()->value());
    }
}
