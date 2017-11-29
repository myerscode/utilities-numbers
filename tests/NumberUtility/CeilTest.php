<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class CeilTest extends BaseNumberSuite
{

    public function ceilValueProvider()
    {
        return [
            [5, 4.3],
            [10, 9.999],
            [-3, -3.14],
            [0, 0],
            [1, 0.00000000001],
        ];
    }

    /**
     * Check the number is rounded up correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider ceilValueProvider
     * @covers ::ceil
     */
    public function testExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->ceil()->value());
    }
}
