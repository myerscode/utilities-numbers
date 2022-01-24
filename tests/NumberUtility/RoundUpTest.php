<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Tests\BaseNumberSuite;

class RoundUpTest extends BaseNumberSuite
{
    public function __validData(): array
    {
        return [
            [4, 4.3],
            [5, 4.5],
            [10, 9.999],
            [-3, -3.14],
            [0, 0],
            [0, 0.00000000001],
        ];
    }

    public function __validPrecisionData(): array
    {
        return [
            [4, 4.2345, 0],
            [4.2, 4.2345, 1],
            [4.23, 4.2345, 2],
            [4.235, 4.2345, 3],
            [4.2345, 4.2345, 4],
            [4.2345, 4.2345, 6],
        ];
    }

    public function testExpectedInvalidPrecision(): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility(12.3456)->roundUp(-1)->value();
    }

    /**
     * @dataProvider __validData
     */
    public function testExpectedResults($expected, $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp()->value());
    }

    /**
     * @dataProvider __validPrecisionData
     */
    public function testPrecisionExpectedResults($expected, $number, $precision): void
    {
        $this->assertEquals($expected, $this->utility($number)->roundUp($precision)->value());
    }
}
