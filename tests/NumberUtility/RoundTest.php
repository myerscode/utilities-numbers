<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use ReflectionClass;
use Tests\BaseNumberSuite;


final class RoundTest extends BaseNumberSuite
{

    public function __invalidData(): Iterator
    {
        yield [10, 9.5, -1, PHP_ROUND_HALF_UP];
    }

    public function __validData(): Iterator
    {
        yield [10, 9.5, 0, PHP_ROUND_HALF_UP];
        yield [9, 9.5, 0, PHP_ROUND_HALF_DOWN];
        yield [10, 9.5, 0, PHP_ROUND_HALF_EVEN];
        yield [9, 9.5, 0, PHP_ROUND_HALF_ODD];
        yield [9, 8.5, 0, PHP_ROUND_HALF_UP];
        yield [8, 8.5, 0, PHP_ROUND_HALF_DOWN];
        yield [8, 8.5, 0, PHP_ROUND_HALF_EVEN];
        yield [9, 8.5, 0, PHP_ROUND_HALF_ODD];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testExpectedInvalidNumberException(int $expected, float $number, int $precision, int $mode): void
    {
        $this->expectException(InvalidNumberException::class);
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass($utility::class);
        $reflectionMethod = $reflectionClass->getMethod('round');
        $reflectionMethod->invokeArgs($utility, [$number, $precision, $mode]);
        $this->assertEquals($expected, $utility->value());
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults(int $expected, float $number, int $precision, int $mode): void
    {
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass($utility::class);
        $reflectionMethod = $reflectionClass->getMethod('round');

        $newNumber = $reflectionMethod->invokeArgs($utility, [$number, $precision, $mode]);

        $this->assertEquals($expected, $newNumber->value());
    }
}
