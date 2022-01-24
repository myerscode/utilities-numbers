<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;


class OrdinalTest extends BaseNumberSuite
{
    public function __validData(): array
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
     * @dataProvider __validData
     */
    public function testGetNumbersOrdinalValue($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->ordinal());
    }
}
