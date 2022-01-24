<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Tests\BaseNumberSuite;

class ConstructTest extends BaseNumberSuite
{

    public function __invalidData(): array
    {
        return [
            ['fred'],
        ];
    }

    public function __validData(): array
    {
        return [
            [1, 1],
            [1, '1'],
            [0.123456, '0.123456'],
            [0, ''],
        ];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testInvalidValueSetViaConstructor($number): void
    {
        $this->expectException(NonNumericValueException::class);
        $this->utility($number);
    }

    /**
     * @dataProvider __validData
     */
    public function testValidValueSetViaConstructor($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->value());
    }
}
