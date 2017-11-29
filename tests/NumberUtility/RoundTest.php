<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class RoundTest extends BaseNumberSuite
{

    public function roundValueProvider()
    {
        return [
            [10, 9.5, 0, PHP_ROUND_HALF_UP],
            [9, 9.5, 0, PHP_ROUND_HALF_DOWN],
            [10, 9.5, 0, PHP_ROUND_HALF_EVEN],
            [9, 9.5, 0, PHP_ROUND_HALF_ODD],
            [9, 8.5, 0, PHP_ROUND_HALF_UP],
            [8, 8.5, 0, PHP_ROUND_HALF_DOWN],
            [8, 8.5, 0, PHP_ROUND_HALF_EVEN],
            [9, 8.5, 0, PHP_ROUND_HALF_ODD],
        ];
    }

    public function invalidValueProvider()
    {
        return [
            [10, 9.5, -1, PHP_ROUND_HALF_UP],
        ];
    }

    /**
     * Check that the number is rounded correctly
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @param string $precision How precise to round
     * @param string $mode Round mode
     * @dataProvider roundValueProvider
     * @covers ::round
     */
    public function testExpectedResults($expected, $number, $precision, $mode)
    {
        $class = $this->utility($number);
        $reflection = new \ReflectionClass(get_class($class));
        $method = $reflection->getMethod('round');
        $method->setAccessible(true);
        $newNumber = $method->invokeArgs($class, [$number, $precision, $mode]);

        $this->assertEquals($expected, $newNumber->value());
    }

    /**
     * Check that a InvalidNumberException is thrown with invalid precision
     *
     * @param string $expected The value expected to be returned
     * @param string $number The value to pass to the utility
     * @param string $precision How precise to round
     * @param string $mode Round mode
     * @dataProvider invalidValueProvider
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException
     * @covers ::round
     */
    public function testExpectedInvalidNumberException($expected, $number, $precision, $mode)
    {
        $class = $this->utility($number);
        $reflection = new \ReflectionClass(get_class($class));
        $method = $reflection->getMethod('round');
        $method->setAccessible(true);
        $method->invokeArgs($class, [$number, $precision, $mode]);
        $this->assertEquals($expected, $class->value());
    }
}
