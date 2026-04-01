<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Myerscode\Utilities\Numbers\Utility;
use stdClass;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class MakeTest extends BaseNumberSuite
{
    public static function __invalidData(): Iterator
    {
        yield ['fred'];
    }

    public static function __validData(): Iterator
    {
        yield [1, 1];
        yield [1, '1'];
        yield [0.123456, '0.123456'];
        yield [0, ''];
    }

    #[DataProvider('__invalidData')]
    public function testInvalidValueSetViaConstructor(string $number): void
    {
        $this->expectException(NonNumericValueException::class);
        Utility::make($number);
    }

    #[DataProvider('__validData')]
    public function testValidValueSetViaConstructor(int|float $expected, int|string $number): void
    {
        $this->assertEquals($expected, Utility::make($number)->value());
    }
}
