<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use Tests\BaseNumberSuite;

class IsNegativeTest extends BaseNumberSuite
{

    public function __invalidData(): array
    {
        return [
            'minus zero' => [-0],
            'zero' => [0],
        ];
    }

    public function __validData(): array
    {
        return [
            'negative zero decimal' => [true, -0.123],
            'negative number' => [true, -123],
            'zero decimal' => [false, 0.123],
            'positive number' => [false, 123],
            'decimal' => [false, 123.123],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->isNegative());
    }

    /**
     * @dataProvider __invalidData
     */
    public function testIsZeroExceptionIsThrownWithZeroValue($zero): void
    {
        $this->expectException(IsZeroException::class);
        $this->utility($zero)->isNegative();
    }

}
