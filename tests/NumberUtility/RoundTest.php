<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use ReflectionClass;
use RoundingMode;
use Tests\BaseNumberSuite;

final class RoundTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [10, 9.5, -1, RoundingMode::HalfAwayFromZero];
    }

    public static function __validData(): Iterator
    {
        yield [10, 9.5, 0, RoundingMode::HalfAwayFromZero];
        yield [9, 9.5, 0, RoundingMode::HalfTowardsZero];
        yield [10, 9.5, 0, RoundingMode::HalfEven];
        yield [9, 9.5, 0, RoundingMode::HalfOdd];
        yield [9, 8.5, 0, RoundingMode::HalfAwayFromZero];
        yield [8, 8.5, 0, RoundingMode::HalfTowardsZero];
        yield [8, 8.5, 0, RoundingMode::HalfEven];
        yield [9, 8.5, 0, RoundingMode::HalfOdd];
    }

    #[DataProvider('__invalidData')]
    public function testExpectedInvalidNumberException(int $expected, float $number, int $precision, RoundingMode $mode): void
    {
        $this->expectException(InvalidNumberException::class);
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass($utility::class);
        $reflectionMethod = $reflectionClass->getMethod('round');
        $reflectionMethod->invokeArgs($utility, [$precision, $mode]);
        $this->assertEquals($expected, $utility->value());
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float $number, int $precision, RoundingMode $mode): void
    {
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass($utility::class);
        $reflectionMethod = $reflectionClass->getMethod('round');

        $newNumber = $reflectionMethod->invokeArgs($utility, [$precision, $mode]);

        $this->assertEquals($expected, $newNumber->value());
    }
}
