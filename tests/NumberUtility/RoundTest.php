<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use ReflectionClass;
use Tests\BaseNumberSuite;


class RoundTest extends BaseNumberSuite
{

    public function __invalidData(): array
    {
        return [
            [10, 9.5, -1, PHP_ROUND_HALF_UP],
        ];
    }

    public function __validData(): array
    {
        return [
            [10, 9.5, 0, PHP_ROUND_HALF_UP],
            [9, 9.5, 0, PHP_ROUND_HALF_DOWN],
            [10, 9.5, 0, PHP_ROUND_HALF_EVEN],
            [9, 9.5, 0, PHP_ROUND_HALF_ODD],
            [9, 8.5, 0, PHP_ROUND_HALF_UP],
            [8, 8.5, 0, PHP_ROUND_HALF_DOWN],
            [8, 8.5, 0, PHP_ROUND_HALF_EVEN],
            [9, 8.5, 0, PHP_ROUND_HALF_ODD],
        ];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testExpectedInvalidNumberException($expected, $number, $precision, $mode): void
    {
        $this->expectException(InvalidNumberException::class);
        $class = $this->utility($number);
        $reflectionClass = new ReflectionClass(get_class($class));
        $method = $reflectionClass->getMethod('round');
        $method->setAccessible(true);
        $method->invokeArgs($class, [$number, $precision, $mode]);
        $this->assertEquals($expected, $class->value());
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $precision, $mode): void
    {
        $class = $this->utility($number);
        $reflectionClass = new ReflectionClass(get_class($class));
        $method = $reflectionClass->getMethod('round');
        $method->setAccessible(true);

        $newNumber = $method->invokeArgs($class, [$number, $precision, $mode]);

        $this->assertEquals($expected, $newNumber->value());
    }
}
