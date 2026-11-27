<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class FloorTest extends BaseNumberSuite
{
    public static function __precisionData(): Iterator
    {
        yield [4.23, 4.2345, 2];
        yield [1200, 1234, -2];
        yield [-3.15, -3.141, 2];
    }
    public static function __validData(): Iterator
    {
        yield [4, 4.3];
        yield [9, 9.999];
        yield [-4, -3.14];
        yield [0, 0];
        yield [0, 0.00000000001];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->floor()->value());
    }

    #[DataProvider('__precisionData')]
    public function testRoundsToPrecision(float|int $expected, float|int $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->floor($precision)->value());
    }
}
