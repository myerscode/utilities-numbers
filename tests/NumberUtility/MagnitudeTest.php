<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class MagnitudeTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [0, 0],
            [1, 11.235523],
            [-5, -0.000011235523],
            [13, -12_315_639_128_398.0],
            [3, 1000],
            [2, 999.999999],
            [-2, 0.01],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->magnitude()->value());
    }
}
