<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Utility;
use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class MakeTest extends BaseNumberSuite
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
            ['fred'],
        ];
    }

    /**
     * Create a new instance of the utility class using the make method.
     * Check that the value is assigned correctly.
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @dataProvider __constructValidProvider
     * @covers ::make
     */
    public function testValidValueSetViaConstructor($expected, $number)
    {
        $this->assertEquals($expected, Utility::make($number)->value());
    }

    /**
     * Try and create a new instance of the utility class using an invalid value.
     * Expect to get a NonNumericValueException exception
     *
     * @param string $number The value to pass to the utility
     * @dataProvider __constructInvalidProvider
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException
     * @covers ::make
     */
    public function testInvalidValueSetViaConstructor($number)
    {
        Utility::make($number);
    }
}
