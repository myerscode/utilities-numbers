<?php

namespace Tests;

use Myerscode\Utilities\Numbers\Utility;
use PHPUnit\Framework\TestCase;

abstract class BaseNumberSuite extends TestCase
{

    /**
     * Utility class name
     *
     * @var string $utility
     */
    public $utility = Utility::class;


    public function utility($config = 0): Utility
    {
        return new Utility($config);
    }
}
