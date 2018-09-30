<?php

namespace Tests\NumberUtility;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Tests\BaseNumberSuite;

class FactorsTest extends BaseNumberSuite
{

    public function dataProvider(): array
    {
        return [
            [ 5, [1, 5] ],
            [ 10, [1, 2, 5, 10] ],
            [ 12, [1, 2, 3, 4, 6, 12] ],
            [ 999, [1, 3, 9, 27, 37, 111, 333, 999] ],
        ];
    }

    public function invalidDataProvider(): array
    {
        return [
            [0],
            [7.49]
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param int $number
     * @param array $expected
     */
    public function testFactorsMethod(int $number, array $expected)
    {
        $this->assertEquals($expected, $this->utility($number)->factors());
    }

    /**
     * @dataProvider invalidDataProvider
     * @expectedException \Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException
     */
    public function testFactorsMethodThrowException($number)
    {
        $this->utility($number)->factors();
    }
}