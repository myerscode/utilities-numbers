<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class MultiplyTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [0, 0, 0];
        yield [0, 0, 7];
        yield [49, 7, 7];
        yield [-49, -7, 7];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int $number, int $multiply): void
    {
        $this->assertEquals($expected, $this->utility($number)->multiply($multiply)->value());
    }
}
