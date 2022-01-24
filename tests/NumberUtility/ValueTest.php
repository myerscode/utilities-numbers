<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class ValueTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            ['7', 7],
            ['7', '7'],
            ['0.77', 0.77],
            ['-7', -7],
            ['-7', '-7'],
            ['-0.77', -0.77],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testGetUtilityValue($expected, $number): void
    {
        $this->assertEquals($expected, (string)$this->utility($number)->value());
    }

    /**
     * @dataProvider __validData
     */
    public function testNumberConvertedToString(string $expected, float|int|string $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->__toString());
    }
}
