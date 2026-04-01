<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;


final class OrdinalTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield ['st', 1];
        yield ['nd', 2];
        yield ['rd', 3];
        yield ['th', 4];
        yield ['th', 20];
        yield ['st', 31];
        yield ['nd', 42];
        yield ['rd', 53];
    }

    #[DataProvider('__validData')]
    public function testGetNumbersOrdinalValue(string $expected, int $number): void
    {
        $this->assertSame($expected, $this->utility($number)->ordinal());
    }
}
