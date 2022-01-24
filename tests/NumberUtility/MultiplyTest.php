<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class MultiplyTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [0, 0, 0],
            [0, 0, 7],
            [49, 7, 7],
            [-49, -7, 7],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $multiply): void
    {
        $this->assertEquals($expected, $this->utility($number)->multiply($multiply)->value());
    }
}
