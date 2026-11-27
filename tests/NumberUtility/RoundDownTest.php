<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class RoundDownTest extends BaseNumberSuite
{
    public static function __negativePrecisionData(): Iterator
    {
        yield [10, 12.3456, -1];
        yield [0, 12.3456, -2];
        yield [1200, 1234, -2];
        yield [-20, -12.3456, -1];
    }
    public static function __validData(): Iterator
    {
        yield [4, 4.3];
        yield [4, 4.9];
        yield [9, 9.999];
        yield [-4, -3.14];
        yield [-4, -3.9];
        yield [0, 0];
        yield [0, 0.00000000001];
    }

    public static function __validPrecisionData(): Iterator
    {
        yield [4, 4.2345, 0];
        yield [4.2, 4.2345, 1];
        yield [4.23, 4.2345, 2];
        yield [4.234, 4.2345, 3];
        yield [4.2345, 4.2345, 4];
        yield [4.2345, 4.2345, 6];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown()->value());
    }

    #[DataProvider('__negativePrecisionData')]
    public function testNegativePrecisionRoundsToTensAndHundreds(int $expected, float|int $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown($precision)->value());
    }

    #[DataProvider('__validPrecisionData')]
    public function testPrecisionExpectedResults(int|float $expected, float $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown($precision)->value());
    }
}
