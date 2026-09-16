<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AsAbbreviatedTest extends BaseNumberSuite
{
    public static function __precisionData(): Iterator
    {
        yield ['1.23K', 1234, 2];
        yield ['1K', 1234, 0];
        yield ['1.235K', 1234.5, 3];
    }

    public static function __validData(): Iterator
    {
        yield ['0', 0];
        yield ['999', 999];
        yield ['1K', 1000];
        yield ['1.5K', 1500];
        yield ['1M', 1000000];
        yield ['2.5M', 2500000];
        yield ['1B', 1000000000];
        yield ['2.5B', 2500000000];
        yield ['1T', 1000000000000];
        yield ['-1.5K', -1500];
        yield ['-1M', -1000000];
        yield ['1.2K', 1200];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->asAbbreviated());
    }

    #[DataProvider('__precisionData')]
    public function testRespectsPrecision(string $expected, int|float $number, int $precision): void
    {
        $this->assertSame($expected, $this->utility($number)->asAbbreviated($precision));
    }
}
