<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class ClampTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [5, 5, 1, 10];
        yield [1, -5, 1, 10];
        yield [10, 15, 1, 10];
        yield [0, 0, 0, 100];
        yield [50, 50, 0, 100];
        yield [-1, -1, -10, 10];
        yield [-10, -20, -10, 10];
        yield [5.5, 5.5, 1.0, 10.0];
        yield [1.0, 0.5, 1.0, 10.0];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertEquals($expected, $this->utility($number)->clamp($min, $max)->value());
    }
}
