<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsPositiveTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield 'zero' => [false, 0];
        yield 'zero decimal float' => [false, 0.0];
        yield 'negative zero float' => [false, -0.0];
        yield 'positive number' => [true, 123];
        yield 'positive decimal' => [true, 0.123];
        yield 'negative number' => [false, -123];
        yield 'negative decimal' => [false, -0.123];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, float|int $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isPositive());
    }
}
