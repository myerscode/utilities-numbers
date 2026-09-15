<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class LcmTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [5.5, 10];
        yield [10, 5.5];
        yield [2.5, 2.5];
    }

    public static function __validData(): Iterator
    {
        yield [12, 4, 6];
        yield [42, 21, 6];
        yield [0, 0, 5];
        yield [0, 5, 0];
        yield [0, 0, 0];
        yield [12, -4, 6];
        yield [12, 4, -6];
        yield [12, -4, -6];
        yield [7, 7, 7];
        yield [15, 3, '5'];
        yield [36, 12, 18];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int|float|string $number, int|float|string $with): void
    {
        $this->assertSame($expected, $this->utility($number)->lcm($with)->value());
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForNonIntegers(int|float $number, int|float $with): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->lcm($with);
    }
}
