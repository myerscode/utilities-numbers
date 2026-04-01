<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsEvenTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 0];
        yield [true, 2];
        yield [true, -4];
        yield [true, 100];
        yield [false, 1];
        yield [false, -3];
        yield [false, 99];
        yield [false, 1.5];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isEven());
    }
}
