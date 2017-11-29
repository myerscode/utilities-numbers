<?php

namespace Tests\NumberUtility;

use Tests\BaseNumberSuite;

/**
 * @coversDefaultClass Myerscode\Utilities\Numbers\Utility
 */
class ImmutableTest extends BaseNumberSuite
{

    /**
     * Check the number is immutable
     */
    public function testExpectedResults()
    {
        $utility = $this->utility(123);

        $this->assertEquals(10, $utility->add(7)->minus(30)->divide(10)->value());
        $this->assertEquals(123, $utility->value());
    }
}
