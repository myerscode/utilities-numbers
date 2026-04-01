<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class RoundDownTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [4, 4.3];
        yield [10, 9.999];
        yield [-3, -3.14];
        yield [0, 0];
        yield [0, 0.00000000001];
    }

    public static function __validPrecisionData(): Iterator
    {
        yield [4, 4.2345, 0];
        yield [4.2, 4.2345, 1];
        yield [4.23, 4.2345, 2];
        yield [4.234, 4.2345, 3];
        yield [4.2345, 4.2345, 4];
        yield [4.2345, 4.2345, 6];
    }

    public function testExpectedInvalidPrecision(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(12.3456)->roundDown(-1)->value();
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, float|int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown()->value());
    }

    #[DataProvider('__validPrecisionData')]
    public function testPrecisionExpectedResults(int|float $expected, float $number, int $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundDown($precision)->value());
    }
}
