<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class OrdinalTest extends BaseNumberSuite
{

    public function ordinalValueProvider()
    {
        return [
            ['st', 1],
            ['nd', 2],
            ['rd', 3],
            ['th', 4],
            ['th', 20],
            ['st', 31],
            ['nd', 42],
            ['rd', 53],
        ];
    }

    /**
     * Get the ordinal of the number
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider ordinalValueProvider
     * @covers ::ordinal
     */
    public function testGetNumbersOrdinalValue($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->ordinal());
    }
}
