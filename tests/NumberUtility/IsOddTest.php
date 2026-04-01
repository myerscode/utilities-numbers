<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsOddTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 1];
        yield [true, -3];
        yield [true, 99];
        yield [false, 0];
        yield [false, 2];
        yield [false, -4];
        yield [false, 100];
        yield [false, 1.5];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isOdd());
    }
}
