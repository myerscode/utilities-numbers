<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Stringable;

/**
 * Class Utility
 *
 * @package Myerscode\Utilities\Numbers
 */
class Utility implements Stringable
{
    /**
     * The value this model is representing
     *
     * @var  mixed  number
     */
    private readonly mixed $number;

    /**
     * Utility constructor.
     *
     * @throws NonNumericValueException
     */
    public function __construct(int|float|string|Utility $number)
    {
        if (is_numeric($number)) {
            // set the value to a numeric format
            $number += 0;
        } elseif (empty($number)) {
            $number = 0;
        } else {
            $message = gettype($number).' cannot be cast to a valid number';
            throw new NonNumericValueException($message);
        }

        $this->number = $number;
    }

    /**
     * Create a new instance of the number utility
     *
     * @throws NonNumericValueException
     */
    public static function make(int|float|string|Utility $number): Utility
    {
        return new Utility($number);
    }

    /**
     * Return the value when casting to string
     */
    public function __toString(): string
    {
        return (string)$this->value();
    }

    /**
     * Add a number to current number
     *
     * @throws NonNumericValueException
     */
    public function add(int|float|string|Utility $number): Utility
    {
        $number = $this->number + (new static($number))->value();

        return static::make($number);
    }

    /**
     * Ceil the number
     *
     * @throws NonNumericValueException
     */
    public function ceil(): Utility
    {
        $value = ceil($this->number);

        return static::make($value);
    }

    /**
     * Divide the number by the number
     *
     * @throws NonNumericValueException
     */
    public function divide(int|float|string|Utility $number): Utility
    {
        $static = static::make($number);

        if ($static->value() == 0 || $this->number == 0) {
            throw new DivisionByZeroError();
        }

        $value = $this->number / $static->value();

        return static::make($value);
    }

    /**
     * Get the factors for the number
     *
     * @throws InvalidNumberException
     * @return float[]|int[]
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
        for ($i = 1; $i <= $sqrx; ++$i) {
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
     * @throws NonNumericValueException
     */
    public function floor(): Utility
    {
        $value = floor($this->number);

        return static::make($value);
    }

    /**
     * Is the number negative
     *
     * @throws IsZeroException
     */
    public function isNegative(): bool
    {
        if ($this->number === 0) {
            throw new IsZeroException('0 is neither positive or negative');
        }

        return (!is_int($this->number) && $this->number < 0 || $this->number < 0);
    }

    /**
     * Get the order of magnitude of the number
     *
     * @throws NonNumericValueException
     */
    public function magnitude(): Utility
    {
        $magnitude = $this->number == 0 ? 0 : floor(log10(abs($this->number)));

        return static::make($magnitude);
    }

    /**
     * Minus a number
     *
     * @throws NonNumericValueException
     */
    public function minus(int|float|string|Utility $number): Utility
    {
        $value = $this->number - (static::make($number))->value();

        return static::make($value);
    }

    /**
     * Multiply a number
     *
     * @throws NonNumericValueException
     */
    public function multiply(int|float|string|Utility $number): Utility
    {
        $value = $this->number * (static::make($number))->value();

        return static::make($value);
    }

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     */
    public function ordinal(): string
    {
        $abs = abs($this->number);

        return match ($abs % 10) {
            1 => ($abs % 100 === 11) ? 'th' : 'st',
            2 => ($abs % 100 === 12) ? 'th' : 'nd',
            3 => ($abs % 100 === 13) ? 'th' : 'rd',
            default => 'th',
        };
    }

    /**
     * Add padding on the right of the number, with a given padding value
     */
    public function padLeft(int $padding = 1): string
    {
        return $this->pad($padding, STR_PAD_LEFT);
    }

    /**
     * Add padding on the right of the number, with a given padding value
     */
    public function padRight(int $padding = 1): string
    {
        return $this->pad($padding, STR_PAD_RIGHT);
    }

    /**
     * Get the number to a given power
     *
     * @throws NonNumericValueException
     */
    public function power(int $exponent): Utility
    {
        return static::make($this->number ** $exponent);
    }

    /**
     * Round down the number
     *
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
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function roundUp(int $precision = 0): Utility
    {
        return $this->round($this->number, $precision, PHP_ROUND_HALF_UP);
    }

    /**
     * The numbers type
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
     * @return int|float
     */
    public function value(): mixed
    {
        return $this->number;
    }

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     */
    public function withOrdinal(string $spacer = ''): string
    {
        return $this->number.$spacer.$this->ordinal();
    }

    /**
     * Add padding to the number
     */
    private function pad(int $padding = 1, int $direction = STR_PAD_BOTH): string
    {
        return str_pad($this->number, $padding, 0, $direction);
    }

    /**
     * Round a number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    private function round(float|int $number, int $precision, int $mode): Utility
    {
        if ($precision < 0) {
            throw new InvalidNumberException('Precision value should be greater or equal to zero');
        }

        $value = round($number, $precision, $mode);

        return static::make($value);
    }
}
