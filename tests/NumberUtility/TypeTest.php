<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Tests\BaseNumberSuite;

final class TypeTest extends BaseNumberSuite
{
    public function __validData(): Iterator
    {
        yield ['int', 1];
        yield ['float', 1.0];
    }

    /**
     * @dataProvider __validData
     */
    public function testValidValueSetViaConstructor(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->type());
    }
}
