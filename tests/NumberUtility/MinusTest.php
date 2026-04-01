<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class MinusTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [0, 5, 5];
        yield [0.999, 1, 0.001];
        yield [0, 0, 0];
        yield [-2, -1, 1];
        yield [2, 1, -1];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int $number, int|float $minus): void
    {
        $this->assertEquals($expected, $this->utility($number)->minus($minus)->value());
    }
}
