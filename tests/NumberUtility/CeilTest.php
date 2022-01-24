<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class CeilTest extends BaseNumberSuite
{

    public function __validData(): array
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
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->ceil()->value());
    }
}
