<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class MultiplyTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield [0, 0, 0];
        yield [0, 0, 7];
        yield [49, 7, 7];
        yield [-49, -7, 7];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults(int $expected, int $number, int $multiply): void
    {
        $this->assertEquals($expected, $this->utility($number)->multiply($multiply)->value());
    }
}
