<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class PadRightTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [100, 3, 1],
            [1, 0, 1],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $pad, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->padRight($pad));
    }
}
