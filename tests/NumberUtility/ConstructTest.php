<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Tests\BaseNumberSuite;

final class ConstructTest extends BaseNumberSuite
{

    public function __invalidData(): Iterator
    {
        yield ['fred'];
    }

    public function __validData(): Iterator
    {
        yield [1, 1];
        yield [1, '1'];
        yield [0.123456, '0.123456'];
        yield [0, ''];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testInvalidValueSetViaConstructor(string $number): void
    {
        $this->expectException(NonNumericValueException::class);
        $this->utility($number);
    }

    /**
     * @dataProvider __validData
     */
    public function testValidValueSetViaConstructor(int|float $expected, int|string $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->value());
    }
}
