<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class AddTest extends BaseNumberSuite
{

    public function __validData(): array
    {
        return [
            [10, 5, 5],
            [1.001, 1, 0.001],
            [0, 0, 0],
            [0, -1, 1],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $addition): void
    {
        $this->assertEquals($expected, $this->utility($number)->add($addition)->value());
    }
}
