<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

class ImmutableTest extends BaseNumberSuite
{
    public function testExpectedResults(): void
    {
        $utility = $this->utility(123);

        $this->assertEquals(10, $utility->add(7)->minus(30)->divide(10)->value());
        $this->assertEquals(123, $utility->value());
    }
}
