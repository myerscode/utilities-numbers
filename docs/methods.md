# Methods

A fluent interface for interacting with numbers, providing immutable arithmetic, rounding, formatting, and inspection methods.

## Available Methods

| | | | |
|---|---|---|---|
| [abs](#abs) | [factors](#factors) | [minus](#minus) | [power](#power) |
| [add](#add) | [floor](#floor) | [multiply](#multiply) | [roundDown](#rounddown) |
| [ceil](#ceil) | [isNegative](#isnegative) | [ordinal](#ordinal) | [roundUp](#roundup) |
| [divide](#divide) | [isPositive](#ispositive) | [padLeft](#padleft) | [type](#type) |
| [make](#make) | [isZero](#iszero) | [padRight](#padright) | [value](#value) |
|  | [magnitude](#magnitude) | [withOrdinal](#withordinal) |  |

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

### isNegative
> Returns `bool`

Check if the number is negative. Throws `IsZeroException` for zero.
```php
(new Utility(-5))->isNegative();
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
