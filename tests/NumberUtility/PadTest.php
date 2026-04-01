<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;


final class PadTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [001, 3, 1, STR_PAD_LEFT];
        yield [1, 0, 1, STR_PAD_LEFT];
        yield [100, 3, 1, STR_PAD_RIGHT];
        yield [1, 0, 1, STR_PAD_RIGHT];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int $padding, int $number, int $mode): void
    {
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass($utility::class);
        $reflectionMethod = $reflectionClass->getMethod('pad');
        $this->assertEquals($expected, $reflectionMethod->invokeArgs($utility, [$padding, $mode]));
    }
}
