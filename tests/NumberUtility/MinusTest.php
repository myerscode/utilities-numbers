<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class MinusTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [0, 5, 5],
            [0.999, 1, 0.001],
            [0, 0, 0],
            [-2, -1, 1],
            [2, 1, -1],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $minus): void
    {
        $this->assertEquals($expected, $this->utility($number)->minus($minus)->value());
    }
}
