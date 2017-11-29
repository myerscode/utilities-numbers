<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class TypeTest extends BaseNumberSuite
{

    public function typeValueProvider()
    {
        return [
            ['int', 1],
            ['float', 1.0],
        ];
    }

    /**
     * Get the type of the number
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider typeValueProvider
     * @covers ::type
     */
    public function testValidValueSetViaConstructor($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->type());
    }
}
