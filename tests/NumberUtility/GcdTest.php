<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class GcdTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [5.5, 10];
        yield [10, 5.5];
        yield [2.5, 2.5];
    }

    public static function __validData(): Iterator
    {
        yield [4, 12, 8];
        yield [6, 54, 24];
        yield [1, 17, 5];
        yield [5, 5, 5];
        yield [7, 0, 7];
        yield [7, 7, 0];
        yield [0, 0, 0];
        yield [4, -12, 8];
        yield [4, 12, -8];
        yield [4, -12, -8];
        yield [3, 9, '6'];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int|float|string $number, int|float|string $with): void
    {
        $this->assertSame($expected, $this->utility($number)->gcd($with)->value());
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForNonIntegers(int|float $number, int|float $with): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->gcd($with);
    }
}
