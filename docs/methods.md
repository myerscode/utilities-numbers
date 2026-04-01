# Methods

A fluent interface for interacting with numbers, providing immutable arithmetic, rounding, formatting, and inspection methods.

## Available Methods

| | | | |
|---|---|---|---|
| [abs](#abs) | [isBetween](#isbetween) | [make](#make) | [power](#power) |
| [add](#add) | [isEven](#iseven) | [minus](#minus) | [roundDown](#rounddown) |
| [ceil](#ceil) | [isNegative](#isnegative) | [modulo](#modulo) | [roundUp](#roundup) |
| [clamp](#clamp) | [isOdd](#isodd) | [multiply](#multiply) | [sqrt](#sqrt) |
| [divide](#divide) | [isPositive](#ispositive) | [ordinal](#ordinal) | [type](#type) |
| [factors](#factors) | [isZero](#iszero) | [padLeft](#padleft) | [value](#value) |
| [floor](#floor) | [magnitude](#magnitude) | [padRight](#padright) | [withOrdinal](#withordinal) |

### abs
> Returns `Utility`

Get the absolute value of the number.
```php
echo (new Utility(-5))->abs()->value();
// 5
```

### add
> Returns `Utility`

Add a number to the current value.
```php
echo (new Utility(5))->add(10)->value();
// 15
```

### ceil
> Returns `Utility`

Round up the number using ceil.
```php
echo (new Utility(4.3))->ceil()->value();
// 5
```

### clamp
> Returns `Utility`

Constrain the number between a minimum and maximum value.
```php
echo (new Utility(15))->clamp(1, 10)->value();
// 10
echo (new Utility(-5))->clamp(0, 100)->value();
// 0
```

### divide
> Returns `Utility`

Divide the current value by the given number.
```php
echo (new Utility(25))->divide(5)->value();
// 5
```

### factors
> Returns `array`

Get the factors of the current number.
```php
(new Utility(12))->factors();
// [1, 2, 3, 4, 6, 12]
```

### floor
> Returns `Utility`

Round down the value using floor.
```php
echo (new Utility(4.3))->floor()->value();
// 4
```

### isBetween
> Returns `bool`

Check if the number is between two values (inclusive).
```php
(new Utility(5))->isBetween(1, 10);
// true
(new Utility(11))->isBetween(1, 10);
// false
```

### isEven
> Returns `bool`

Check if the number is an even integer. Returns false for floats.
```php
(new Utility(4))->isEven();
// true
```

### isNegative
> Returns `bool`

Check if the number is negative. Throws `IsZeroException` for zero.
```php
(new Utility(-5))->isNegative();
// true
```

### isOdd
> Returns `bool`

Check if the number is an odd integer. Returns false for floats.
```php
(new Utility(3))->isOdd();
// true
```

### isPositive
> Returns `bool`

Check if the number is positive. Throws `IsZeroException` for zero.
```php
(new Utility(5))->isPositive();
// true
```

### isZero
> Returns `bool`

Check if the number is zero.
```php
(new Utility(0))->isZero();
// true
```

### magnitude
> Returns `Utility`

Get the order of magnitude of the number.
```php
echo (new Utility(1000))->magnitude()->value();
// 3
```

### make
> Returns `Utility`

Static factory method to create a new Utility instance.
```php
$n = Utility::make(42);
```

### minus
> Returns `Utility`

Subtract a value from the number.
```php
echo (new Utility(14))->minus(7)->value();
// 7
```

### modulo
> Returns `Utility`

Get the remainder after division. Throws `DivisionByZeroError` for zero divisor.
```php
echo (new Utility(10))->modulo(3)->value();
// 1
```

### multiply
> Returns `Utility`

Multiply the number by the given value.
```php
echo (new Utility(7))->multiply(7)->value();
// 49
```

### ordinal
> Returns `string`

Get the ordinal suffix of a number (st, nd, rd, th).
```php
echo (new Utility(1))->ordinal();
// st
```

### padLeft
> Returns `string`

Pad the number on the left to a given length.
```php
echo (new Utility(1))->padLeft(3);
// 001
```

### padRight
> Returns `string`

Pad the number on the right to a given length.
```php
echo (new Utility(1))->padRight(3);
// 100
```

### power
> Returns `Utility`

Raise the number to a given exponent.
```php
echo (new Utility(5))->power(3)->value();
// 125
```

### roundDown
> Returns `Utility`

Round down the number to a given precision.
```php
echo (new Utility(4.5))->roundDown()->value();
// 4
echo (new Utility(4.2345))->roundDown(2)->value();
// 4.23
```

### roundUp
> Returns `Utility`

Round up the number to a given precision.
```php
echo (new Utility(4.5))->roundUp()->value();
// 5
echo (new Utility(4.2345))->roundUp(3)->value();
// 4.235
```

### sqrt
> Returns `Utility`

Get the square root of the number. Throws `InvalidNumberException` for negative numbers.
```php
echo (new Utility(9))->sqrt()->value();
// 3
```

### type
> Returns `string`

Get the type name of the current value.
```php
echo (new Utility(7))->type();
// int
echo (new Utility(4.9))->type();
// float
```

### value
> Returns `int|float`

Get the current numeric value.
```php
echo (new Utility(42))->value();
// 42
```

### withOrdinal
> Returns `string`

Get the number with its ordinal suffix.
```php
echo (new Utility(1))->withOrdinal();
// 1st
echo (new Utility(2))->withOrdinal(' ');
// 2 nd
```
