<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsBetweenTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 5, 1, 10];
        yield [true, 1, 1, 10];
        yield [true, 10, 1, 10];
        yield [false, 0, 1, 10];
        yield [false, 11, 1, 10];
        yield [true, -5, -10, 0];
        yield [false, 1, -10, 0];
        yield [true, 5.5, 5.0, 6.0];
        yield [false, 4.9, 5.0, 6.0];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number, int|float $min, int|float $max): void
    {
        $this->assertSame($expected, $this->utility($number)->isBetween($min, $max));
    }

    public function testEpsilonAllowsTolerance(): void
    {
        $this->assertFalse($this->utility(0.1 + 0.2)->isBetween(0.0, 0.3));
        $this->assertTrue($this->utility(0.1 + 0.2)->isBetween(0.0, 0.3, 1e-9));
        $this->assertTrue($this->utility(0.9)->isBetween(1, 2, 0.1));
        $this->assertFalse($this->utility(0.8)->isBetween(1, 2, 0.1));
    }

    public function testNegativeEpsilonThrows(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(1)->isBetween(0, 2, -0.1);
    }
}
