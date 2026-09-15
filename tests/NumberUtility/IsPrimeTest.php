<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsPrimeTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 2];
        yield [true, 3];
        yield [true, 5];
        yield [true, 7];
        yield [true, 13];
        yield [true, 97];
        yield [true, 7919];
        yield [false, 0];
        yield [false, 1];
        yield [false, 4];
        yield [false, 9];
        yield [false, 100];
        yield [false, -7];
        yield [false, -1];
        yield [false, 7.0];
        yield [false, 5.5];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isPrime());
    }
}
