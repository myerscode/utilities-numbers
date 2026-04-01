<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsNegativeTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield 'minus zero' => [-0];
        yield 'zero' => [0];
    }

    public static function __validData(): Iterator
    {
        yield 'negative zero decimal' => [true, -0.123];
        yield 'negative number' => [true, -123];
        yield 'zero decimal' => [false, 0.123];
        yield 'positive number' => [false, 123];
        yield 'decimal' => [false, 123.123];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, float|int $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isNegative());
    }

    #[DataProvider('__invalidData')]
    public function testIsZeroExceptionIsThrownWithZeroValue(int $zero): void
    {
        $this->expectException(IsZeroException::class);
        $this->utility($zero)->isNegative();
    }

}
