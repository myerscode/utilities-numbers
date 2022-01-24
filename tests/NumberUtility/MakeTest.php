<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Myerscode\Utilities\Numbers\Utility;
use stdClass;
use Tests\BaseNumberSuite;

class MakeTest extends BaseNumberSuite
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
        Utility::make($number);
    }

    /**
     * @dataProvider __validData
     */
    public function testValidValueSetViaConstructor($expected, $number): void
    {
        $this->assertEquals($expected, Utility::make($number)->value());
    }
}
