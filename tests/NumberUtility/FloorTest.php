<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class FloorTest extends BaseNumberSuite
{

    public function __validData(): array
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
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->floor()->value());
    }
}
