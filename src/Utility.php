<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;

/**
 * Class Utility
 *
 * @package Myerscode\Utilities\Numbers
 */
class Utility
{
    /**
     * The value this model is representing
     *
     * @var number
     */
    private $number;

    /**
     * Utility constructor.
     *
     * @param $number
     *
     * @throws NonNumericValueException
     */
    public function __construct($number)
    {
        if (is_numeric($number)) {
            // set the value to a numeric format
            $number += 0;
        } else {
            if (empty($number)) {
                $number = 0;
            } else {
                $message = gettype($number) . ' cannot be cast to a valid number';
                throw new NonNumericValueException($message);
            }
        }

        $this->number = $number;
    }

    /**
     * Add a number to current number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function add($number)
    {
        $number = $this->number + (new static($number))->value();

        return new static($number);
    }

    /**
     * Ceil the number
     *
     * @return Utility
     */
    public function ceil()
    {
        $value = ceil($this->number);

        return new static($value);
    }

    /**
     * Divide the number by the number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     * @throws \DivisionByZeroError
     */
    public function divide($number)
    {
        $divisible = new static($number);

        if ($divisible->value() == 0 || $this->number == 0) {
            throw new DivisionByZeroError();
        }

        $value = $this->number / $divisible->value();

        return new static($value);
    }

    /**
     * Return the value when casting to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value();
    }

    /**
     * Get the current value of the number
     *
     * @return number
     */
    public function value()
    {
        return $this->number;
    }
}
