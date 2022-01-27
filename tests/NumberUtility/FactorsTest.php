<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Tests\BaseNumberSuite;

class FactorsTest extends BaseNumberSuite
{

    public function __invalidData(): array
    {
        return [
            [0],
            [7.49],
        ];
    }

    public function __validData(): array
    {
        return [
            [5, [1, 5]],
            [10, [1, 2, 5, 10]],
            [12, [1, 2, 3, 4, 6, 12]],
            [999, [1, 3, 9, 27, 37, 111, 333, 999]],
        ];
    }

    /**
     * @dataProvider __validData
     */
    public function testFactorsMethod($number, $expected): void
    {
        $this->assertEquals($expected, $this->utility($number)->factors());
    }

    /**
     * @dataProvider __invalidData
     */
    public function testFactorsMethodThrowException($number): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->factors();
    }
}
