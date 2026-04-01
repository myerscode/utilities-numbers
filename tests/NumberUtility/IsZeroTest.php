<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsZeroTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 0];
        yield [true, 0.0];
        yield [false, 1];
        yield [false, -1];
        yield [false, 0.001];
        yield [false, -0.001];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isZero());
    }
}
