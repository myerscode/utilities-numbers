<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class SqrtTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [0, 0];
        yield [1, 1];
        yield [2, 4];
        yield [3, 9];
        yield [10, 100];
        yield [1.4142135623730951, 2];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(float|int $expected, int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->sqrt()->value());
    }

    public function testThrowsExceptionForNegativeNumber(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(-4)->sqrt();
    }
}
