<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class PadLeftTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield [001, 3, 1];
        yield [1, 0, 1];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults(int $expected, int $pad, int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->padLeft($pad));
    }
}
