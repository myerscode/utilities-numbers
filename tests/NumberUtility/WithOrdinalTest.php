<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class WithOrdinalTest extends BaseNumberSuite
{
    public function __validData(): array
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
     * @dataProvider __validData
     */
    public function testAppendedExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->withOrdinal());
    }
}
