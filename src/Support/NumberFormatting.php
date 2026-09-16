<?php

namespace Myerscode\Utilities\Numbers\Support;

use Myerscode\Utilities\Numbers\Exceptions\InvalidNumberException;
use NumberFormatter;

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
     * Format a fraction as a locale aware percentage
     *
     * @throws InvalidNumberException
     */
    public function percentage(int|float $fraction, int $precision = 0, string $locale = 'en'): string
    {
        $formatter = new NumberFormatter($locale, NumberFormatter::PERCENT);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);

        $formatted = $formatter->format($fraction);

        if ($formatted === false) {
            throw new InvalidNumberException('The number could not be formatted as a percentage');
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
        $formatter = new NumberFormatter($locale, NumberFormatter::SPELLOUT);

        $formatted = $formatter->format($number);

        if ($formatted === false) {
            throw new InvalidNumberException('The number could not be spelled out');
        }

        return $formatted;
    }
}
