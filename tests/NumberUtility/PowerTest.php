<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;


class PowerTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [0, 0, 9],
            [1, 1, -10],
            [16, 2, 4],
            [1, 3, 0],
            [125, 5, 3],
            [823543, 7, 7],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $exponent): void
    {
        $this->assertEquals($expected, $this->utility($number)->power($exponent)->value());
    }
}
