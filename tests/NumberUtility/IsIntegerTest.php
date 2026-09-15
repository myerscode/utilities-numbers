<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsIntegerTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 5];
        yield [true, 0];
        yield [true, -5];
        yield [false, 5.5];
        yield [false, 0.0];
        yield [false, -5.5];
        yield [true, '10'];
        yield [false, '10.5'];
        yield [true, ''];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float|string $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isInteger());
    }
}
