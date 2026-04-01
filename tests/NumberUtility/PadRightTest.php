<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class PadRightTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield [100, 3, 1];
        yield [1, 0, 1];
    }

    #[DataProvider('__validData')]
    public function testExpectedResults(int $expected, int $pad, int $number): void
    {
        $this->assertEquals($expected, $this->utility($number)->padRight($pad));
    }
}
