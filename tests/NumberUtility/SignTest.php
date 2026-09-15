<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class SignTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [1, 5];
        yield [1, 0.5];
        yield [-1, -5];
        yield [-1, -0.5];
        yield [0, 0];
        yield [0, 0.0];
        yield [1, 999999];
        yield [-1, -999999];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->sign()->value());
    }
}
