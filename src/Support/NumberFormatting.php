<?php

namespace Myerscode\Utilities\Numbers\Support;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use IntlException;
use NumberFormatter;
use ValueError;

/**
 * A stateless wrapper around the intl NumberFormatter.
 *
 * This helper intentionally instantiates NumberFormatter internally rather than
 * receiving it via injection. NumberFormatter is a pure, deterministic, offline
 * collaborator (no I/O, network, or clock), so there is no test-double value in
 * mocking it - tests assert the real formatted output. Keeping it here also keeps
 * the intl dependency out of the immutable Utility constructor and its many
 * `new self(...)` calls.
 */
class NumberFormatting
{
    /**
     * Formatters shared across instances, keyed by locale and style. Callers must set the attributes they rely on.
     *
     * @var array<string, NumberFormatter>
     */
    private static array $formatters = [];

    /**
     * Format a number with locale aware separators, rounding half away from zero (as number_format does)
     *
     * @throws InvalidNumberException
     */
    public function decimal(int|float $number, int $minFractionDigits, int $maxFractionDigits, string $locale): string
    {
        $formatter = $this->formatter($locale, NumberFormatter::DECIMAL);
        $formatter->setAttribute(NumberFormatter::MIN_FRACTION_DIGITS, $minFractionDigits);
        $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $maxFractionDigits);
        $formatter->setAttribute(NumberFormatter::ROUNDING_MODE, NumberFormatter::ROUND_HALFUP);

        $formatted = $formatter->format($number);

        if ($formatted === false) {
            // NumberFormatter::format() only returns false on internal intl errors, unreachable for int|float input
            // @codeCoverageIgnoreStart
            throw new InvalidNumberException('The number could not be formatted');
            // @codeCoverageIgnoreEnd
        }

        return $formatted;
    }

    /**
     * Format a fraction as a locale aware percentage
     *
     * @throws InvalidNumberException
     */
    public function percentage(int|float $fraction, int $precision = 0, string $locale = 'en'): string
    {
        $formatter = $this->formatter($locale, NumberFormatter::PERCENT);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);

        $formatted = $formatter->format($fraction);

        if ($formatted === false) {
            // NumberFormatter::format() only returns false on internal intl errors, unreachable for int|float input
            // @codeCoverageIgnoreStart
            throw new InvalidNumberException('The number could not be formatted as a percentage');
            // @codeCoverageIgnoreEnd
        }

        return $formatted;
    }

    /**
     * Spell out a number in words for the given locale
     *
     * @throws InvalidNumberException
     */
    public function spellOut(int|float $number, string $locale = 'en'): string
    {
        $formatter = $this->formatter($locale, NumberFormatter::SPELLOUT);

        $formatted = $formatter->format($number);

        if ($formatted === false) {
            // NumberFormatter::format() only returns false on internal intl errors, unreachable for int|float input
            // @codeCoverageIgnoreStart
            throw new InvalidNumberException('The number could not be spelled out');
            // @codeCoverageIgnoreEnd
        }

        return $formatted;
    }

    /**
     * @throws InvalidNumberException
     */
    private function formatter(string $locale, int $style): NumberFormatter
    {
        $key = $locale . '|' . $style;

        try {
            return self::$formatters[$key] ??= new NumberFormatter($locale, $style);
        } catch (IntlException|ValueError $e) {
            throw new InvalidNumberException('Invalid locale: ' . $locale, 0, $e);
        }
    }
}
