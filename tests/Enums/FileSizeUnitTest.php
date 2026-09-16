<?php

declare(strict_types=1);

namespace Tests\Enums;

use Iterator;
use Myerscode\Utilities\Numbers\Enums\FileSizeUnit;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class FileSizeUnitTest extends TestCase
{
    public static function __bytesData(): Iterator
    {
        yield [1, FileSizeUnit::B];
        yield [1024, FileSizeUnit::KB];
        yield [1048576, FileSizeUnit::MB];
        yield [1073741824, FileSizeUnit::GB];
        yield [1099511627776, FileSizeUnit::TB];
        yield [1125899906842624, FileSizeUnit::PB];
    }

    public static function __exponentData(): Iterator
    {
        yield [0, FileSizeUnit::B];
        yield [1, FileSizeUnit::KB];
        yield [2, FileSizeUnit::MB];
        yield [3, FileSizeUnit::GB];
        yield [4, FileSizeUnit::TB];
        yield [5, FileSizeUnit::PB];
    }

    public static function __suffixData(): Iterator
    {
        yield ['B', FileSizeUnit::B];
        yield ['KB', FileSizeUnit::KB];
        yield ['MB', FileSizeUnit::MB];
        yield ['GB', FileSizeUnit::GB];
        yield ['TB', FileSizeUnit::TB];
        yield ['PB', FileSizeUnit::PB];
    }

    #[DataProvider('__bytesData')]
    public function testBytes(int $expected, FileSizeUnit $unit): void
    {
        $this->assertSame($expected, $unit->bytes());
    }

    #[DataProvider('__exponentData')]
    public function testExponent(int $expected, FileSizeUnit $unit): void
    {
        $this->assertSame($expected, $unit->exponent());
    }

    #[DataProvider('__suffixData')]
    public function testSuffix(string $expected, FileSizeUnit $unit): void
    {
        $this->assertSame($expected, $unit->suffix());
    }
}
