<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class NormalizeTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [5, 10, 10];
        yield [5, 0, 0];
        yield [5, 2.5, 2.5];
    }

    public static function __validData(): Iterator
    {
        yield [0.5, 50, 0, 100];
        yield [0, 0, 0, 100];
        yield [1, 100, 0, 100];
        yield [0.5, 15, 10, 20];
        yield [0.05, 5, 0, 100];
        yield [-1, -10, 0, 10];
        yield [0.5, 0, -10, 10];
        yield [2, 200, 0, 100];
        yield [0.25, 2.5, 0, 10];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertEqualsWithDelta($expected, $this->utility($number)->normalize($min, $max)->value(), 0.0000001);
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForEqualBounds(int|float $number, int|float $min, int|float $max): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->normalize($min, $max);
    }
}
