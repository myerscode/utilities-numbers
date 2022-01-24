<?php

namespace Tests\NumberUtility;

use ReflectionClass;
use Tests\BaseNumberSuite;


class PadTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [001, 3, 1, STR_PAD_LEFT],
            [1, 0, 1, STR_PAD_LEFT],
            [100, 3, 1, STR_PAD_RIGHT],
            [1, 0, 1, STR_PAD_RIGHT],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $padding, $number, $mode): void
    {
        $utility = $this->utility($number);
        $reflectionClass = new ReflectionClass(get_class($utility));
        $reflectionMethod = $reflectionClass->getMethod('pad');
        $reflectionMethod->setAccessible(true);
        $this->assertEquals($expected, $reflectionMethod->invokeArgs($utility, [$padding, $mode]));
    }
}
