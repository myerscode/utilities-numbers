<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class PadTest extends BaseNumberSuite
{

    public function roundValueProvider()
    {
        return [
            [001, 3, 1, STR_PAD_LEFT],
            [1, 0, 1, STR_PAD_LEFT],
            [100, 3, 1, STR_PAD_RIGHT],
            [1, 0, 1, STR_PAD_RIGHT],
        ];
    }


    /**
     * Check that the number is rounded correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $padding How many numbers to pad
     * @param string $number The value to pass to the utility
     * @param string $mode Round mode
     * @dataProvider roundValueProvider
     * @covers ::pad
     */
    public function testExpectedResults($expected, $padding, $number, $mode)
    {
        $class = $this->utility($number);
        $reflection = new \ReflectionClass(get_class($class));
        $method = $reflection->getMethod('pad');
        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invokeArgs($class, [$padding, $mode]));
    }
}
