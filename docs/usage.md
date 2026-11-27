# Utility Usage

Create an instance of the fluent interface by creating a new instance either via `new Utility($val)` or `Utility::make($val)`

```php
$util = new Utility(123);
echo $util->add(7)->minus(30)->divide(10);
// 10

// the original $util is unchanged
echo $util;
// 123

$n = Utility::make(123);
echo $n->add(7)->minus(30)->divide(10);
// 10

// the original $util is unchanged
echo $n;
// 123
```

## Overflow

Integer arithmetic (`add`, `minus`, `multiply`, `power`, `abs`, `lcm`) never silently turns into a float. If the result of integer operands is outside the integer range, an `InvalidNumberException` is thrown. Use float operands if you need the larger range.

```php
Utility::make(PHP_INT_MAX)->add(1);
// throws InvalidNumberException

Utility::make(PHP_INT_MAX)->add(1.0)->value();
// 9.223372036854776E+18
```

`factorial` is capped at `20`, the largest factorial that fits in an integer. Larger values throw `InvalidNumberException`.

## Empty values

An empty or whitespace-only string throws `InvalidNumberException`; other non-numeric strings throw `NonNumericValueException`.

## Locales

`asAbbreviated`, `asFileSize`, `asPercentage` and `asWords` use PHP's `intl` extension for locale aware output, so `ext-intl` is required. An unknown locale throws `InvalidNumberException`.
