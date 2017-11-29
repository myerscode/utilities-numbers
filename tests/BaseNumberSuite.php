<?php

namespace Tests;

use Myerscode\Utilities\Numbers\Utility;
use PHPUnit\Framework\TestCase;

abstract class BaseNumberSuite extends TestCase
{
    /**
     * Value that will be passed into the utility helper
     *
     * @var mixed
     */
    public $config;

    /**
     * Utility class name
     *
     * @var string $utility
     */
    public $utility = Utility::class;


    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * {@inheritdoc}
     *
     * @param null $config
     * @return Utility
     */
    public function utility($config = null)
    {
        if (empty($config)) {
            $config = $this->getConfig();
        }

        return new Utility($config);
    }
}
