<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class MapRangeTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [5, 10, 10, 0, 100];
        yield [5, 0, 0, 0, 1];
        yield [5, 2.5, 2.5, 0, 1];
    }

    public static function __validData(): Iterator
    {
        yield [50, 5, 0, 10, 0, 100];
        yield [0, 0, 0, 10, 0, 100];
        yield [100, 10, 0, 10, 0, 100];
        yield [150, 5, 0, 10, 100, 200];
        yield [0.5, 50, 0, 100, 0, 1];
        yield [-50, 5, 0, 10, 0, -100];
        yield [0.5, 15, 10, 20, 0, 1];
        yield [50, 0, -10, 10, 0, 100];
        yield [200, 20, 0, 10, 0, 100];
        yield [2.5, 25, 0, 100, 0, 10];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(
        int|float $expected,
        int|float $number,
        int|float $inMin,
        int|float $inMax,
        int|float $outMin,
        int|float $outMax,
    ): void {
        $result = $this->utility($number)->mapRange($inMin, $inMax, $outMin, $outMax)->value();
        $this->assertEqualsWithDelta($expected, $result, 0.0000001);
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForEqualInputBounds(
        int|float $number,
        int|float $inMin,
        int|float $inMax,
        int|float $outMin,
        int|float $outMax,
    ): void {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->mapRange($inMin, $inMax, $outMin, $outMax);
    }
}
