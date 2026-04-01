<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use RoundingMode;
use Stringable;

class Utility implements Stringable
{
    private readonly int|float $number;

    /**
     * Utility constructor.
     *
     * @throws NonNumericValueException
     */
    public function __construct(int|float|string|Utility $number)
    {
        if ($number instanceof self) {
            $number = $number->value();
        } elseif (is_numeric($number)) {
            $number += 0;
        } elseif ($number === '') {
            $number = 0;
        } else {
            throw new NonNumericValueException(
                gettype($number) . ' cannot be cast to a valid number',
            );
        }

        $this->number = $number;
    }

    /**
     * Return the value when casting to string
     */
    public function __toString(): string
    {
        return (string) $this->number;
    }

    /**
     * Create a new instance of the number utility
     *
     * @throws NonNumericValueException
     */
    public static function make(int|float|string|Utility $number): self
    {
        return new self($number);
    }

    /**
     * Get the absolute value
     *
     * @throws NonNumericValueException
     */
    public function abs(): self
    {
        return new self(abs($this->number));
    }

    /**
     * Add a number to current number
     *
     * @throws NonNumericValueException
     */
    public function add(int|float|string|Utility $number): self
    {
        return new self($this->number + $this->resolve($number));
    }

    /**
     * Ceil the number
     *
     * @throws NonNumericValueException
     */
    public function ceil(): self
    {
        return new self(ceil($this->number));
    }

    /**
     * Clamp the number between a minimum and maximum
     *
     * @throws NonNumericValueException
     */
    public function clamp(int|float|string|Utility $min, int|float|string|Utility $max): self
    {
        $minValue = $this->resolve($min);
        $maxValue = $this->resolve($max);

        return new self(max($minValue, min($maxValue, $this->number)));
    }

    /**
     * Divide the number by the given value
     *
     * @throws DivisionByZeroError
     * @throws NonNumericValueException
     */
    public function divide(int|float|string|Utility $number): self
    {
        $divisor = $this->resolve($number);

        if ($divisor == 0 || $this->number == 0) {
            throw new DivisionByZeroError();
        }

        return new self($this->number / $divisor);
    }

    /**
     * Get the factors for the number
     *
     * @throws InvalidNumberException
     * @return int[]
     */
    public function factors(): array
    {
        if ($this->number === 0 || !is_int($this->number)) {
            throw new InvalidNumberException();
        }

        $x = abs($this->number);
        $sqrx = (int) floor(sqrt($x));

        $factors = [];
        for ($i = 1; $i <= $sqrx; ++$i) {
            if ($x % $i === 0) {
                $factors[] = $i;
                $pair = intdiv($x, $i);
                if ($pair !== $i) {
                    $factors[] = $pair;
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
    public function floor(): self
    {
        return new self(floor($this->number));
    }

    /**
     * Check if the number is between two values (inclusive)
     *
     * @throws NonNumericValueException
     */
    public function isBetween(int|float|string|Utility $min, int|float|string|Utility $max): bool
    {
        $minValue = $this->resolve($min);
        $maxValue = $this->resolve($max);

        return $this->number >= $minValue && $this->number <= $maxValue;
    }

    /**
     * Check if the number is even
     */
    public function isEven(): bool
    {
        return is_int($this->number) && $this->number % 2 === 0;
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

        return $this->number < 0;
    }

    /**
     * Check if the number is odd
     */
    public function isOdd(): bool
    {
        return is_int($this->number) && $this->number % 2 !== 0;
    }

    /**
     * Is the number positive
     *
     * @throws IsZeroException
     */
    public function isPositive(): bool
    {
        if ($this->number === 0) {
            throw new IsZeroException('0 is neither positive or negative');
        }

        return $this->number > 0;
    }

    /**
     * Check if the number is zero
     */
    public function isZero(): bool
    {
        return $this->number == 0;
    }

    /**
     * Get the order of magnitude of the number
     *
     * @throws NonNumericValueException
     */
    public function magnitude(): self
    {
        $magnitude = $this->number == 0 ? 0 : floor(log10(abs($this->number)));

        return new self($magnitude);
    }

    /**
     * Minus a number
     *
     * @throws NonNumericValueException
     */
    public function minus(int|float|string|Utility $number): self
    {
        return new self($this->number - $this->resolve($number));
    }

    /**
     * Get the modulus of the number
     *
     * @throws DivisionByZeroError
     * @throws NonNumericValueException
     */
    public function modulo(int|float|string|Utility $number): self
    {
        $divisor = $this->resolve($number);

        if ($divisor == 0) {
            throw new DivisionByZeroError();
        }

        return new self(fmod($this->number, $divisor));
    }

    /**
     * Multiply a number
     *
     * @throws NonNumericValueException
     */
    public function multiply(int|float|string|Utility $number): self
    {
        return new self($this->number * $this->resolve($number));
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
     * Pad the number on the left
     */
    public function padLeft(int $padding = 1): string
    {
        return $this->pad($padding, STR_PAD_LEFT);
    }

    /**
     * Pad the number on the right
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
    public function power(int $exponent): self
    {
        return new self($this->number ** $exponent);
    }

    /**
     * Round down the number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function roundDown(int $precision = 0): self
    {
        return $this->round($precision, RoundingMode::HalfTowardsZero);
    }

    /**
     * Round up the number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function roundUp(int $precision = 0): self
    {
        return $this->round($precision, RoundingMode::HalfAwayFromZero);
    }

    /**
     * The numbers type
     */
    public function type(): string
    {
        return is_int($this->number) ? 'int' : 'float';
    }

    /**
     * Get the current value of the number
     */
    public function value(): int|float
    {
        return $this->number;
    }

    /**
     * Returns the number with its ordinal suffix
     */
    public function withOrdinal(string $spacer = ''): string
    {
        return $this->number . $spacer . $this->ordinal();
    }

    /**
     * Add padding to the number
     */
    private function pad(int $padding = 1, int $direction = STR_PAD_BOTH): string
    {
        return str_pad((string) $this->number, $padding, '0', $direction);
    }

    /**
     * Resolve a value to its numeric form
     *
     * @throws NonNumericValueException
     */
    private function resolve(int|float|string|Utility $number): int|float
    {
        if ($number instanceof self) {
            return $number->value();
        }

        return (new self($number))->value();
    }

    /**
     * Round a number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    private function round(int $precision, RoundingMode $mode): self
    {
        if ($precision < 0) {
            throw new InvalidNumberException('Precision value should be greater or equal to zero');
        }

        return new self(round($this->number, $precision, $mode));
    }
}
