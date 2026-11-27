<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class RoundUpTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [5, 4.3];
        yield [5, 4.5];
        yield [4, 4.0];
        yield [10, 9.999];
        yield [-3, -3.14];
        yield [-3, -3.9];
        yield [0, 0];
        yield [1, 0.00000000001];
    }

    public static function __validPrecisionData(): Iterator
    {
        yield [5, 4.2345, 0];
        yield [4.3, 4.2345, 1];
        yield [4.24, 4.2345, 2];
        yield [4.235, 4.2345, 3];
        yield [4.2345, 4.2345, 4];
        yield [4.2345, 4.2345, 6];
    }

    public static function __negativePrecisionData(): Iterator
    {
        yield [20, 12.3456, -1];
        yield [100, 12.3456, -2];
        yield [1300, 1234, -2];
        yield [-10, -12.3456, -1];
    }

    #[DataProvider('__negativePrecisionData')]
    public function testNegativePrecisionRoundsToTensAndHundreds(int $expected, float|int $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp($precision)->value());
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp()->value());
    }

    #[DataProvider('__validPrecisionData')]
    public function testPrecisionExpectedResults(int|float $expected, float $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp($precision)->value());
    }
}
