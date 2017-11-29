<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
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
     * Floor the number
     *
     * @return Utility
     */
    public function floor()
    {
        $value = floor($this->number);

        return new static($value);
    }

    /**
     * Minus a number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function minus($number)
    {
        $value = $this->number - (new static($number))->value();

        return new static($value);
    }

    /**
     * Multiply a number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function multiply($number)
    {
        $value = $this->number * (new static($number))->value();

        return new static($value);
    }

    /**
     * Add padding to the number
     *
     * @param int $padding
     * @param int $direction
     *
     * @return string
     */
    private function pad($padding = 1, $direction = STR_PAD_BOTH)
    {
        return str_pad($this->number, $padding, 0, $direction);
    }

    /**
     * Add padding on the left of an the number.
     *
     * @param int $padding
     *
     * @return string
     */
    public function padLeft($padding = 1)
    {
        return $this->pad($padding, STR_PAD_LEFT);
    }

    /**
     * Add padding on the right of an the number.
     *
     * @param int $padding
     *
     * @return string
     */
    public function padRight($padding = 1)
    {
        return $this->pad($padding, STR_PAD_RIGHT);
    }

    /**
     * Round a number
     *
     * @param int $precision
     * @param int $mode
     *
     * @return Utility
     * @throws InvalidNumberException
     */
    private function round($number, $precision, int $mode)
    {
        if ($precision < 0) {
            throw new InvalidNumberException('Precision value should be greater or equal to zero');
        }

        $value = round($number, $precision, $mode);

        return new static($value);
    }

    /**
     * Round down the number
     *
     * @param int $precision
     *
     * @return Utility
     * @throws InvalidNumberException
     */
    public function roundDown(int $precision = 0)
    {
        return $this->round($this->number, $precision, PHP_ROUND_HALF_DOWN);
    }

    /**
     * Round up the number
     *
     * @param int $precision
     *
     * @return Utility
     * @throws InvalidNumberException
     */
    public function roundUp(int $precision = 0)
    {
        return $this->round($this->number, $precision, PHP_ROUND_HALF_UP);
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
