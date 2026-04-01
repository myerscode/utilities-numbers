<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Myerscode\Utilities\Numbers\Utility;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class ConstructTest extends BaseNumberSuite
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

    public function testAcceptsUtilityInstance(): void
    {
        $original = $this->utility(42);
        $copy = $this->utility(0)->add($original);
        $this->assertEquals(42, $copy->value());
    }

    public function testConstructorAcceptsUtilityInstance(): void
    {
        $original = $this->utility(99);
        $wrapped = Utility::make($original);
        $this->assertEquals(99, $wrapped->value());
    }

    #[DataProvider('__invalidData')]
    public function testInvalidValueSetViaConstructor(string $number): void
    {
        $this->expectException(NonNumericValueException::class);
        $this->utility($number);
    }

    #[DataProvider('__validData')]
    public function testValidValueSetViaConstructor(int|float $expected, int|string $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->value());
    }
}
