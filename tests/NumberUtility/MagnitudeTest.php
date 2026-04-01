<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class MagnitudeTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield [0, 0];
        yield [1, 11.235523];
        yield [-5, -0.000011235523];
        yield [13, -12_315_639_128_398.0];
        yield [3, 1000];
        yield [2, 999.999999];
        yield [-2, 0.01];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults(int $expected, int|float $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->magnitude()->value());
    }
}
