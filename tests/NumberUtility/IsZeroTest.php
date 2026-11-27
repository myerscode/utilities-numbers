<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class IsZeroTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [true, 0];
        yield [true, 0.0];
        yield [false, 1];
        yield [false, -1];
        yield [false, 0.001];
        yield [false, -0.001];
    }

    public function testEpsilonAllowsTolerance(): void
    {
        $this->assertFalse($this->utility(0.1 + 0.2 - 0.3)->isZero());
        $this->assertTrue($this->utility(0.1 + 0.2 - 0.3)->isZero(1e-9));
        $this->assertTrue($this->utility(-0.001)->isZero(0.001));
        $this->assertFalse($this->utility(0.002)->isZero(0.001));
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(bool $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->isZero());
    }

    public function testNegativeEpsilonThrows(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(0)->isZero(-1.0);
    }
}
