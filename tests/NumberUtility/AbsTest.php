<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AbsTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [5, -5];
        yield [5, 5];
        yield [0, 0];
        yield [3.14, -3.14];
        yield [3.14, 3.14];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int|float $expected, int|float $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->abs()->value());
    }
}
