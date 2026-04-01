<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AddTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [10, 5, 5];
        yield [1.001, 1, 0.001];
        yield [0, 0, 0];
        yield [0, -1, 1];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int $number, int|float $addition): void
    {
        $this->assertEquals($expected, $this->utility($number)->add($addition)->value());
    }
}
