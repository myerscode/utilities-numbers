<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class WithOrdinalTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield ['1st', 1];
        yield ['2nd', 2];
        yield ['3rd', 3];
        yield ['4th', 4];
        yield ['20th', 20];
        yield ['31st', 31];
        yield ['42nd', 42];
        yield ['53rd', 53];
    }

    /**
     * @dataProvider __validData
     */
    public function testAppendedExpectedResults(string $expected, int $number): void
    {
        $this->assertSame($expected, $this->utility($number)->withOrdinal());
    }
}
