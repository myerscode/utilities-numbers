<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
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
     * Return the value when casting to string
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value();
    }

    /**
     * Add a number to current number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function add($number): Utility
    {
        $number = $this->number + (new static($number))->value();

        return new static($number);
    }

    /**
     * Ceil the number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function ceil(): Utility
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
    public function divide($number): Utility
    {
        $divisible = new static($number);

        if ($divisible->value() == 0 || $this->number == 0) {
            throw new DivisionByZeroError();
        }

        $value = $this->number / $divisible->value();

        return new static($value);
    }

    /**
     * Get the factors for the number
     *
     * @return array
     * @throws InvalidNumberException
     */
    public function factors(): array
    {
        // 0 has infinite factors
        if ($this->number === 0 || !is_int($this->number)) {
            throw new InvalidNumberException();
        }

        $x = abs($this->number);
        $sqrx = floor(sqrt($x));

        $factors = [];
        for ($i = 1; $i <= $sqrx; $i++) {
            if ($x % $i === 0) {
                $factors[] = $i;
                if ($i !== $sqrx) {
                    $factors[] = $x / $i;
                }
            }
        }
        sort($factors);
        return $factors;
    }

    /**
     * Floor the number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function floor(): Utility
    {
        $value = floor($this->number);

        return new static($value);
    }

    /**
     * Is the number negative
     *
     * @return bool
     * @throws IsZeroException
     */
    public function isNegative(): bool
    {
        if ($this->number === 0 ){
            throw new IsZeroException('0 is neither positive or negative');
        }
        return (!is_int($this->number) && $this->number < 0 || $this->number < 0);
    }

    /**
     * Create a new instance of the number utility
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public static function make($number): Utility
    {
        return new static($number);
    }

    /**
     * Get the order of magnitude of the number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function magnitude(): Utility
    {
        if ($this->number == 0) {
            $magnitude = 0;
        } else {
            $magnitude = floor(log10(abs($this->number)));
        }

        return new static($magnitude);
    }

    /**
     * Minus a number
     *
     * @param $number
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function minus($number): Utility
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
    public function multiply($number): Utility
    {
        $value = $this->number * (new static($number))->value();

        return new static($value);
    }

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     *
     * @return string
     */
    public function ordinal(): string
    {
        $abs = abs($this->number);

        switch ($abs % 10) {
            case 1:
                $ordinal = ($abs % 100 === 11) ? 'th' : 'st';
                break;
            case 2:
                $ordinal = ($abs % 100 === 12) ? 'th' : 'nd';
                break;
            case 3:
                $ordinal = ($abs % 100 === 13) ? 'th' : 'rd';
                break;
            default:
                $ordinal = 'th';
                break;
        }

        return $ordinal;
    }

    /**
     * Add padding to the number
     *
     * @param int $padding
     * @param int $direction
     *
     * @return string
     */
    private function pad($padding = 1, $direction = STR_PAD_BOTH): string
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
    public function padLeft($padding = 1): string
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
    public function padRight($padding = 1): string
    {
        return $this->pad($padding, STR_PAD_RIGHT);
    }

    /**
     * @param int $exponent
     *
     * @return Utility
     * @throws NonNumericValueException
     */
    public function power(int $exponent): Utility
    {
        return new static(pow($this->number, $exponent));
    }

    /**
     * Round a number
     *
     * @param $number
     * @param int $precision
     * @param int $mode
     *
     * @return Utility
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    private function round($number, $precision, int $mode): Utility
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
     * @throws NonNumericValueException
     */
    public function roundDown(int $precision = 0): Utility
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
     * @throws NonNumericValueException
     */
    public function roundUp(int $precision = 0): Utility
    {
        return $this->round($this->number, $precision, PHP_ROUND_HALF_UP);
    }

    /**
     * The numbers type
     *
     * @return string
     */
    public function type(): string
    {
        $type = gettype($this->number);

        if ('double' == $type) {
            return 'float';
        }

        return 'int';
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

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     *
     * @param string $spacer
     *
     * @return string
     */
    public function withOrdinal($spacer = ''): string
    {
        return $this->number . $spacer . $this->ordinal();
    }
}
