<?php

declare(strict_types=1);

namespace Tests\NumberUtility;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\BaseNumberSuite;

final class TypeTest extends BaseNumberSuite
{
    public static function __validData(): Iterator
    {
        yield ['int', 1];
        yield ['float', 1.0];
    }

    #[DataProvider('__validData')]
    public function testValidValueSetViaConstructor(string $expected, int|float $number): void
    {
        $this->assertSame($expected, $this->utility($number)->type());
    }
}
