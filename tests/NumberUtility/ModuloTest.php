<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use DivisionByZeroError;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class ModuloTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [10, 0];
    }
    public static function __validData(): Iterator
    {
        yield [1, 10, 3];
        yield [0, 10, 5];
        yield [0, 0, 5];
        yield [2.5, 7.5, 5];
        yield [-1, -10, 3];
    }

    #[DataProvider('__invalidData')]
    public function testDivisionByZeroThrowsException(int $number, int $divisor): void
    {
        $this->expectException(DivisionByZeroError::class);
        $this->utility($number)->modulo($divisor);
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number, int|float $divisor): void
    {
        $this->assertEquals($expected, $this->utility($number)->modulo($divisor)->value());
    }
}
