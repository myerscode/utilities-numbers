<?php

namespace Myerscode\Utilities\Numbers;

use DivisionByZeroError;
use Myerscode\Utilities\Numbers\Enums\FileSizeUnit;
use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use Myerscode\Utilities\Numbers\Exceptions\IsZeroException;
use Myerscode\Utilities\Numbers\Exceptions\NonNumericValueException;
use Myerscode\Utilities\Numbers\Support\NumberFormatting;
use RoundingMode;
use Stringable;

class Utility implements Stringable
{
    private readonly int|float $number;

    /**
     * Utility constructor.
     *
     * @throws NonNumericValueException
     * @throws InvalidNumberException
     */
    public function __construct(int|float|string|Utility $number)
    {
        if ($number instanceof self) {
            $number = $number->value();
        } elseif (is_numeric($number)) {
            $number += 0;

            if (is_float($number) && !is_finite($number)) {
                throw new InvalidNumberException('Number must be finite');
            }
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
        return new self($this->exact(abs($this->number), $this->number));
    }

    /**
     * Add a number to current number
     *
     * @throws NonNumericValueException
     */
    public function add(int|float|string|Utility $number): self
    {
        $other = $this->resolve($number);

        return new self($this->exact($this->number + $other, $this->number, $other));
    }

    /**
     * Format the number in a compact, human readable form (e.g. 1500 becomes 1.5K)
     *
     * @param string|null $locale format the separators for this locale, null keeps the default "1,234.5" style
     *
     * @throws InvalidNumberException
     */
    public function asAbbreviated(int $precision = 1, ?string $locale = null): string
    {
        $suffixes = ['', 'K', 'M', 'B', 'T'];

        $magnitude = abs($this->number);

        if ($magnitude < 1000) {
            return (string) $this->number;
        }

        $max = count($suffixes) - 1;
        $power = min((int) floor(log($magnitude, 1000)), $max);
        $scaled = $this->number / (1000 ** $power);

        // rounding can carry into the next unit (999999 -> 1000K), so promote it (capped at the largest suffix)
        if ($power < $max && abs(round($scaled, $precision)) >= 1000) {
            ++$power;
            $scaled = $this->number / (1000 ** $power);
        }

        if ($locale !== null) {
            return (new NumberFormatting())->decimal($scaled, 0, $precision, $locale) . $suffixes[$power];
        }

        $formatted = number_format($scaled, $precision);

        if (str_contains($formatted, '.')) {
            $formatted = rtrim(rtrim($formatted, '0'), '.');
        }

        return $formatted . $suffixes[$power];
    }

    /**
     * Format the number (in bytes) as a human readable file size
     *
     * @param string|null $locale format the separators for this locale, null keeps the default "1,234.50" style
     *
     * @throws InvalidNumberException
     */
    public function asFileSize(FileSizeUnit $unit = FileSizeUnit::KB, int $precision = 2, ?string $locale = null): string
    {
        $value = $this->number / $unit->bytes();

        $formatted = $locale === null
            ? number_format($value, $precision)
            : (new NumberFormatting())->decimal($value, $precision, $precision, $locale);

        return $formatted . ' ' . $unit->suffix();
    }

    /**
     * Format the number as a locale aware percentage of a given value (defaults to a percentage out of 100)
     *
     * @throws DivisionByZeroError
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function asPercentage(int|float|string|Utility $of = 100, int $precision = 0, string $locale = 'en'): string
    {
        $of = $this->resolve($of);

        if ($of == 0) {
            throw new DivisionByZeroError();
        }

        return (new NumberFormatting())->percentage($this->number / $of, $precision, $locale);
    }

    /**
     * Spell out the number in words for the given locale
     *
     * @throws InvalidNumberException
     */
    public function asWords(string $locale = 'en'): string
    {
        return (new NumberFormatting())->spellOut($this->number, $locale);
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

        if ($divisor == 0) {
            throw new DivisionByZeroError();
        }

        return new self($this->number / $divisor);
    }

    /**
     * Get the factorial of the number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function factorial(): self
    {
        if (!is_int($this->number) || $this->number < 0) {
            throw new InvalidNumberException('Factorial is only defined for non-negative integers');
        }

        // 20! is the largest factorial that fits in a 64-bit int
        if ($this->number > 20) {
            throw new InvalidNumberException('Factorial is only supported up to 20');
        }

        $result = 1;
        for ($i = 2; $i <= $this->number; ++$i) {
            $result *= $i;
        }

        return new self($result);
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
     * Get the greatest common divisor of the number and the given value
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function gcd(int|float|string|Utility $number): self
    {
        $other = $this->resolve($number);

        if (!is_int($this->number) || !is_int($other)) {
            throw new InvalidNumberException('The greatest common divisor is only defined for integers');
        }

        return new self($this->greatestCommonDivisor($this->number, $other));
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
     * Check if the number is a float
     */
    public function isFloat(): bool
    {
        return is_float($this->number);
    }

    /**
     * Check if the number is an integer
     */
    public function isInteger(): bool
    {
        return is_int($this->number);
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
     * Check if the number is a prime number
     */
    public function isPrime(): bool
    {
        if (!is_int($this->number) || $this->number < 2) {
            return false;
        }

        if ($this->number < 4) {
            return true;
        }

        if ($this->number % 2 === 0) {
            return false;
        }

        $limit = (int) floor(sqrt($this->number));
        if ($this->number % 3 === 0) {
            return false;
        }

        for ($i = 5; $i <= $limit; $i += 6) {
            if ($this->number % $i === 0 || $this->number % ($i + 2) === 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if the number is zero
     */
    public function isZero(): bool
    {
        return $this->number == 0;
    }

    /**
     * Get the least common multiple of the number and the given value
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function lcm(int|float|string|Utility $number): self
    {
        $other = $this->resolve($number);

        if (!is_int($this->number) || !is_int($other)) {
            throw new InvalidNumberException('The least common multiple is only defined for integers');
        }

        if ($this->number === 0 || $other === 0) {
            return new self(0);
        }

        $gcd = $this->greatestCommonDivisor($this->number, $other);

        return new self($this->exact(abs(intdiv($this->number, $gcd) * $other), $this->number, $other));
    }

    /**
     * Linearly interpolate between a minimum and maximum, using the number as the interpolation factor
     *
     * @throws NonNumericValueException
     */
    public function lerp(int|float|string|Utility $min, int|float|string|Utility $max): self
    {
        $minValue = $this->resolve($min);
        $maxValue = $this->resolve($max);

        return new self($minValue + (($maxValue - $minValue) * $this->number));
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
     * Remap the number from one range to another
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function mapRange(
        int|float|string|Utility $inMin,
        int|float|string|Utility $inMax,
        int|float|string|Utility $outMin,
        int|float|string|Utility $outMax,
    ): self {
        $inMinValue = $this->resolve($inMin);
        $inMaxValue = $this->resolve($inMax);
        $outMinValue = $this->resolve($outMin);
        $outMaxValue = $this->resolve($outMax);

        if ($inMinValue == $inMaxValue) {
            throw new InvalidNumberException('The input minimum and maximum cannot be equal');
        }

        $ratio = ($this->number - $inMinValue) / ($inMaxValue - $inMinValue);

        return new self($outMinValue + ($ratio * ($outMaxValue - $outMinValue)));
    }

    /**
     * Minus a number
     *
     * @throws NonNumericValueException
     */
    public function minus(int|float|string|Utility $number): self
    {
        $other = $this->resolve($number);

        return new self($this->exact($this->number - $other, $this->number, $other));
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
        $other = $this->resolve($number);

        return new self($this->exact($this->number * $other, $this->number, $other));
    }

    /**
     * Normalise the number to a fraction of the range between a minimum and maximum (inverse of lerp)
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function normalize(int|float|string|Utility $min, int|float|string|Utility $max): self
    {
        $minValue = $this->resolve($min);
        $maxValue = $this->resolve($max);

        if ($minValue == $maxValue) {
            throw new InvalidNumberException('The minimum and maximum cannot be equal');
        }

        return new self(($this->number - $minValue) / ($maxValue - $minValue));
    }

    /**
     * Returns the ordinal version of a number (appends th, st, nd, rd).
     */
    public function ordinal(): string
    {
        $abs = fmod(abs($this->number), 100);

        // fractions have no ordinal position, so use the default suffix
        if ($abs !== floor($abs)) {
            return 'th';
        }

        $abs = (int) $abs;

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
        $result = $this->number ** $exponent;

        // a negative exponent legitimately yields a float
        return new self($exponent < 0 ? $result : $this->exact($result, $this->number));
    }

    /**
     * Round down (towards negative infinity) to a given precision, a negative precision rounds to tens, hundreds etc
     *
     * @throws NonNumericValueException
     */
    public function roundDown(int $precision = 0): self
    {
        return $this->round($precision, RoundingMode::NegativeInfinity);
    }

    /**
     * Round up (towards positive infinity) to a given precision, a negative precision rounds to tens, hundreds etc
     *
     * @throws NonNumericValueException
     */
    public function roundUp(int $precision = 0): self
    {
        return $this->round($precision, RoundingMode::PositiveInfinity);
    }

    /**
     * Get the sign of the number (-1 for negative, 0 for zero, 1 for positive)
     *
     * @throws NonNumericValueException
     */
    public function sign(): self
    {
        return new self($this->number <=> 0);
    }

    /**
     * Get the square root of the number
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function sqrt(): self
    {
        if ($this->number < 0) {
            throw new InvalidNumberException('Cannot calculate square root of a negative number');
        }

        return new self(sqrt($this->number));
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
     * Wrap the number around a half-open range [min, max)
     *
     * @throws InvalidNumberException
     * @throws NonNumericValueException
     */
    public function wrap(int|float|string|Utility $min, int|float|string|Utility $max): self
    {
        $minValue = $this->resolve($min);
        $maxValue = $this->resolve($max);

        if ($minValue >= $maxValue) {
            throw new InvalidNumberException('The minimum must be less than the maximum');
        }

        $range = $maxValue - $minValue;
        $wrapped = $minValue + fmod(fmod($this->number - $minValue, $range) + $range, $range);

        if (is_int($this->number) && is_int($minValue) && is_int($maxValue)) {
            return new self((int) $wrapped);
        }

        return new self($wrapped);
    }

    /**
     * Calculate the greatest common divisor of two integers using the Euclidean algorithm
     */
    private function greatestCommonDivisor(int $a, int $b): int
    {
        $a = abs($a);
        $b = abs($b);

        while ($b !== 0) {
            [$a, $b] = [$b, $a % $b];
        }

        return $a;
    }

    /**
     * Guard against integer arithmetic silently overflowing into a float
     *
     * @throws InvalidNumberException
     */
    private function exact(int|float $result, int|float ...$operands): int|float
    {
        if (is_float($result) && array_all($operands, static fn (int|float $o): bool => is_int($o))) {
            throw new InvalidNumberException('Integer overflow: the result exceeds the integer range');
        }

        return $result;
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
     * @throws NonNumericValueException
     */
    private function round(int $precision, RoundingMode $mode): self
    {
        return new self(round($this->number, $precision, $mode));
    }
}
