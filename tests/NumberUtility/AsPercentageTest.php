<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use DivisionByZeroError;
use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AsPercentageTest extends BaseNumberSuite
{
    public static function __ofData(): Iterator
    {
        yield ['25%', 50, 200];
        yield ['50%', 5, 10];
        yield ['10%', 1, 10];
        yield ['200%', 20, 10];
        yield ['100%', 7, 7];
    }

    public static function __outOfHundredData(): Iterator
    {
        yield ['25%', 25];
        yield ['50%', 50];
        yield ['100%', 100];
        yield ['0%', 0];
        yield ['150%', 150];
    }

    public static function __precisionData(): Iterator
    {
        yield ['25.00%', 25, 100, 2];
        yield ['33.33%', 100, 300, 2];
        yield ['12.5%', 12.5, 100, 1];
    }

    #[DataProvider('__outOfHundredData')]
    public function testDefaultsToPercentageOutOfHundred(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->asPercentage());
    }

    #[DataProvider('__ofData')]
    public function testPercentageOfGivenValue(string $expected, int|float $number, int|float $of): void
    {
        $this->assertSame($expected, $this->utility($number)->asPercentage($of));
    }

    #[DataProvider('__precisionData')]
    public function testRespectsPrecision(string $expected, int|float $number, int|float $of, int $precision): void
    {
        $this->assertSame($expected, $this->utility($number)->asPercentage($of, $precision));
    }

    public function testThrowsExceptionWhenOfIsZero(): void
    {
        $this->expectException(DivisionByZeroError::class);
        $this->utility(50)->asPercentage(0);
    }
}
