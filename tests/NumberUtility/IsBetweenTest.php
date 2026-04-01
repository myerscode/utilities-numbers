<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsBetweenTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 5, 1, 10];
        yield [true, 1, 1, 10];
        yield [true, 10, 1, 10];
        yield [false, 0, 1, 10];
        yield [false, 11, 1, 10];
        yield [true, -5, -10, 0];
        yield [false, 1, -10, 0];
        yield [true, 5.5, 5.0, 6.0];
        yield [false, 4.9, 5.0, 6.0];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertSame($expected, $this->utility($number)->isBetween($min, $max));
    }
}
