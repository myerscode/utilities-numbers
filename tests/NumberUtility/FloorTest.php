<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class FloorTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [4, 4.3];
        yield [9, 9.999];
        yield [-4, -3.14];
        yield [0, 0];
        yield [0, 0.00000000001];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->floor()->value());
    }
}
