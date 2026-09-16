<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Enums\FileSizeUnit;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class AsFileSizeTest extends BaseNumberSuite
{
    public static function __defaultUnitData(): Iterator
    {
        yield ['1.00 KB', 1024];
        yield ['0.50 KB', 512];
    }
    public static function __precisionData(): Iterator
    {
        yield ['2 KB', 1536, FileSizeUnit::KB, 0];
        yield ['1.5 KB', 1536, FileSizeUnit::KB, 1];
        yield ['1.500 KB', 1536, FileSizeUnit::KB, 3];
    }

    public static function __unitData(): Iterator
    {
        yield ['500.00 B', 500, FileSizeUnit::B];
        yield ['1.50 KB', 1536, FileSizeUnit::KB];
        yield ['2.50 KB', 2560, FileSizeUnit::KB];
        yield ['1.00 MB', 1048576, FileSizeUnit::MB];
        yield ['1.00 GB', 1073741824, FileSizeUnit::GB];
        yield ['1.00 TB', 1099511627776, FileSizeUnit::TB];
        yield ['1.00 PB', 1125899906842624, FileSizeUnit::PB];
    }

    #[DataProvider('__defaultUnitData')]
    public function testDefaultsToKilobytes(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->asFileSize());
    }

    #[DataProvider('__unitData')]
    public function testFormatsWithGivenUnit(string $expected, int|float $number, FileSizeUnit $unit): void
    {
        $this->assertSame($expected, $this->utility($number)->asFileSize($unit));
    }

    #[DataProvider('__precisionData')]
    public function testRespectsPrecision(string $expected, int|float $number, FileSizeUnit $unit, int $precision): void
    {
        $this->assertSame($expected, $this->utility($number)->asFileSize($unit, $precision));
    }
}
