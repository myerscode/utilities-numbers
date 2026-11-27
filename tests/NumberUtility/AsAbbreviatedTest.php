<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
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
        yield ['1M', 999999];
        yield ['-1M', -999999];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->asAbbreviated());
    }

    public function testInvalidLocaleThrows(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(1500)->asAbbreviated(1, 'not a locale');
    }

    public function testLocaleRoundsHalfUpAndTrimsZeros(): void
    {
        $this->assertSame('1K', $this->utility(1000)->asAbbreviated(1, 'de'));
        $this->assertSame('1,3K', $this->utility(1250)->asAbbreviated(1, 'de'));
    }

    public function testNullLocaleKeepsDefaultOutput(): void
    {
        $this->assertSame($this->utility(1500)->asAbbreviated(), $this->utility(1500)->asAbbreviated(1, null));
    }

    #[DataProvider('__precisionData')]
    public function testRespectsPrecision(string $expected, int|float $number, int $precision): void
    {
        $this->assertSame($expected, $this->utility($number)->asAbbreviated($precision));
    }

    public function testUsesLocaleSeparators(): void
    {
        $this->assertSame('1,5K', $this->utility(1500)->asAbbreviated(1, 'de'));
        $this->assertSame('1,2M', $this->utility(1234567)->asAbbreviated(1, 'fr'));
        $this->assertSame('1.5K', $this->utility(1500)->asAbbreviated(1, 'en'));
        $this->assertSame('999', $this->utility(999)->asAbbreviated(1, 'de'));
    }
}
