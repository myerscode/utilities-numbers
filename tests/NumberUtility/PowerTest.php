<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;


final class PowerTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [0, 0, 9];
        yield [1, 1, -10];
        yield [16, 2, 4];
        yield [1, 3, 0];
        yield [125, 5, 3];
        yield [823543, 7, 7];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int $number, int $exponent): void
    {
        $this->assertEquals($expected, $this->utility($number)->power($exponent)->value());
    }
}
