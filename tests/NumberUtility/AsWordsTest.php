<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AsWordsTest extends BaseNumberSuite
{
    public static function __localeData(): Iterator
    {
        yield ['quarante-deux', 42, 'fr'];
        yield ['cuarenta y dos', 42, 'es'];
    }

    public static function __validData(): Iterator
    {
        yield ['zero', 0];
        yield ['one', 1];
        yield ['five', 5];
        yield ['minus five', -5];
        yield ['twenty-one', 21];
        yield ['forty-two', 42];
        yield ['one hundred', 100];
        yield ['one hundred five', 105];
        yield ['one thousand', 1000];
        yield ['one million', 1000000];
        yield ['three point five', 3.5];
        yield ['zero point two five', 0.25];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->asWords());
    }

    #[DataProvider('__localeData')]
    public function testRespectsLocale(string $expected, int|float $number, string $locale): void
    {
        $this->assertSame($expected, $this->utility($number)->asWords($locale));
    }
}
