<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class LerpTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [0, 0, 0, 100];
        yield [100, 1, 0, 100];
        yield [50, 0.5, 0, 100];
        yield [12.5, 0.25, 10, 20];
        yield [200, 2, 0, 100];
        yield [-10, -1, 0, 10];
        yield [5, 0.5, 0, 10];
        yield [-5, 0.5, -10, 0];
        yield [0, 0.5, 10, -10];
        yield [7.5, 0.75, 0, 10];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertEqualsWithDelta($expected, $this->utility($number)->lerp($min, $max)->value(), 0.0000001);
    }
}
