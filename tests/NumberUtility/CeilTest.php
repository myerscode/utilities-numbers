<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class CeilTest extends BaseNumberSuite
{
    public static function __precisionData(): Iterator
    {
        yield [4.235, 4.2345, 3];
        yield [1300, 1234, -2];
        yield [-3.14, -3.141, 2];
    }
    public static function __validData(): Iterator
    {
        yield [5, 4.3];
        yield [10, 9.999];
        yield [-3, -3.14];
        yield [0, 0];
        yield [1, 0.00000000001];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->ceil()->value());
    }

    #[DataProvider('__precisionData')]
    public function testRoundsToPrecision(float|int $expected, float|int $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->ceil($precision)->value());
    }
}
