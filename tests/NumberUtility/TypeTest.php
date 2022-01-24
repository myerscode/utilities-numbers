<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class TypeTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            ['int', 1],
            ['float', 1.0],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testValidValueSetViaConstructor($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->type());
    }
}
