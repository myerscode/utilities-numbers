<?php

declare(strict_types=1);

namespace Tests\Support;

use Iterator;
use Myerscode\Utilities\Numbers\Support\NumberFormatting;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class NumberFormattingTest extends TestCase
{
    public static function __percentageData(): Iterator
    {
        yield ['25%', 0.25, 0, 'en'];
        yield ['25.00%', 0.25, 2, 'en'];
        yield ['50%', 0.5, 0, 'en'];
        yield ['100%', 1.0, 0, 'en'];
        yield ['0%', 0.0, 0, 'en'];
        yield ['12.5%', 0.125, 1, 'en'];
    }

    public static function __spellOutData(): Iterator
    {
        yield ['forty-two', 42, 'en'];
        yield ['zero', 0, 'en'];
        yield ['minus five', -5, 'en'];
        yield ['three point five', 3.5, 'en'];
        yield ['one hundred', 100, 'en'];
    }

    #[DataProvider('__percentageData')]
    public function testPercentage(string $expected, int|float $fraction, int $precision, string $locale): void
    {
        $this->assertSame($expected, (new NumberFormatting())->percentage($fraction, $precision, $locale));
    }

    #[DataProvider('__spellOutData')]
    public function testSpellOut(string $expected, int|float $number, string $locale): void
    {
        $this->assertSame($expected, (new NumberFormatting())->spellOut($number, $locale));
    }
}
