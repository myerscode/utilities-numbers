<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class ConstructTest extends BaseNumberSuite
{

    public function __constructValidProvider()
    {
        return [
            [1, 1],
            [1, '1'],
            [0.123456, '0.123456'],
            [0, []],
            [0, ''],
            [0, null],
        ];
    }

    public function __constructInvalidProvider()
    {
        return [
            [new \stdClass()],
            ['fred']
        ];
    }

    /**
     * Check the value assigned to the utility via constructor is seen internally
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider __constructValidProvider
     * @covers ::__construct
     */
    public function testValidValueSetViaConstructor($expected, $number)
    {
        $this->assertEquals($expected, $this->utility($number)->value());
    }

    /**
     * Check the value assigned to the utility via constructor is seen internally
     *
     * @param string $number The value to pass to the utility
     * @dataProvider __constructInvalidProvider
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException
     * @covers ::__construct
     */
    public function testInvalidValueSetViaConstructor($number)
    {
        $this->utility($number);
    }
}
