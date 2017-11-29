<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class WithOrdinalTest extends BaseNumberSuite
{

    public function valueProvider()
    {
        return [
            ['1st', 1],
            ['2nd', 2],
            ['3rd', 3],
            ['4th', 4],
            ['20th', 20],
            ['31st', 31],
            ['42nd', 42],
            ['53rd', 53],
        ];
    }

    /**
     * Check the ordinal is returned with value
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider valueProvider
     * @covers ::withOrdinal
     */
    public function testAppendedExpectedResults($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->withOrdinal());
    }
}
