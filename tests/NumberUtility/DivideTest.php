<?php

namespace Tests\NumberUtility;

use DivisionByZeroError;
use Tests\BaseNumberSuite;

class DivideTest extends BaseNumberSuite
{

    public function __invalidData(): array
    {
        return [
            [0, 7],
            [7, 0],
        ];
    }

    public function __validData(): array
    {
        return [
            [1, 7, 7],
            [7, 49, 7],
        ];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testExceptionResults($number, $division): void
    {
        $this->expectException(DivisionByZeroError::class);
        $this->utility($number)->divide($division)->value();
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number, $division): void
    {
        $this->assertEquals($expected, $this->utility($number)->divide($division)->value());
    }
}
