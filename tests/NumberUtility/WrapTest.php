<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class WrapTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [5, 10, 10];
        yield [5, 10, 1];
    }

    public static function __validData(): Iterator
    {
        yield [10, 10, 0, 100];
        yield [5, 105, 0, 100];
        yield [95, -5, 0, 100];
        yield [0, 100, 0, 100];
        yield [0, 0, 0, 100];
        yield [4, 7, 2, 5];
        yield [2, 2, 2, 5];
        yield [-3, -3, -5, 5];
        yield [-4, 6, -5, 5];
        yield [2.5, 2.5, 0.0, 10.0];
        yield [0.5, 10.5, 0.0, 10.0];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertEqualsWithDelta($expected, $this->utility($number)->wrap($min, $max)->value(), 0.0000001);
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForInvalidRange(int|float $number, int|float $min, int|float $max): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->wrap($min, $max);
    }
}
