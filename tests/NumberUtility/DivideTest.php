<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use DivisionByZeroError;
use Tests\BaseNumberSuite;

final class DivideTest extends BaseNumberSuite
{

    public function __invalidData(): Iterator
    {
        yield [0, 7];
        yield [7, 0];
    }

    public function __validData(): Iterator
    {
        yield [1, 7, 7];
        yield [7, 49, 7];
    }

    /**
     * @dataProvider __invalidData
     */
    public function testExceptionResults(int $number, int $division): void
    {
        $this->expectException(DivisionByZeroError::class);
        $this->utility($number)->divide($division)->value();
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults(int $expected, int $number, int $division): void
    {
        $this->assertEquals($expected, $this->utility($number)->divide($division)->value());
    }
}
