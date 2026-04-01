<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Tests\BaseNumberSuite;

final class FactorsTest extends BaseNumberSuite
{

    public function __invalidData(): Iterator
    {
        yield [0];
        yield [7.49];
    }

    public function __validData(): Iterator
    {
        yield [5, [1, 5]];
        yield [10, [1, 2, 5, 10]];
        yield [12, [1, 2, 3, 4, 6, 12]];
        yield [999, [1, 3, 9, 27, 37, 111, 333, 999]];
    }

    /**
     * @dataProvider __validData
     */
    public function testFactorsMethod(int $number, array $expected): void
    {
        $this->assertEquals($expected, $this->utility($number)->factors());
    }

    /**
     * @dataProvider __invalidData
     */
    public function testFactorsMethodThrowException(int|float $number): void
    {
        $this->expectException(InvalidNumberException::class);
        $this->utility($number)->factors();
    }
}
