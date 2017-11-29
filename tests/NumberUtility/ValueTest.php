<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class ValueTest extends BaseNumberSuite
{

    public function valueProvider()
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
     * Check the value is converted to a string correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider valueProvider
     * @covers ::__toString
     */
    public function testNumberConvertedToString($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->__toString());
    }

    /**
     * Check the value is converted back to an string correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider valueProvider
     * @covers ::value
     */
    public function testGetUtilityValue($expected, $number)
    {
        $this->assertEquals($expected, (string)$this->utility($number)->value());
    }
}
