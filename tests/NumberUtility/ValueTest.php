<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class ValueTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield ['7', 7];
        yield ['7', '7'];
        yield ['0.77', 0.77];
        yield ['-7', -7];
        yield ['-7', '-7'];
        yield ['-0.77', -0.77];
    }

    /**
     * @dataProvider __validData
     */
    public function testGetUtilityValue(string $expected, int|string|float $number): void
    {
        $this->assertSame($expected, (string)$this->utility($number)->value());
    }

    /**
     * @dataProvider __validData
     */
    public function testNumberConvertedToString(string $expected, float|int|string $number): void
    {
        $this->assertSame($expected, $this->utility($number)->__toString());
    }
}
