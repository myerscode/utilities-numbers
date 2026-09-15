<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class FactorialTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield [-1];
        yield [-5];
        yield [5.5];
        yield [3.0];
    }

    public static function __validData(): Iterator
    {
        yield [1, 0];
        yield [1, 1];
        yield [2, 2];
        yield [6, 3];
        yield [24, 4];
        yield [120, 5];
        yield [3628800, 10];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int $number): void
    {
        $this->assertSame($expected, $this->utility($number)->factorial()->value());
    }

    #[DataProvider('__invalidData')]
    public function testThrowsExceptionForInvalidNumbers(int|float $number): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->factorial();
    }
}
