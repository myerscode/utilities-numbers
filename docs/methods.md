# Methods

A fluent interface for interacting with numbers, providing immutable arithmetic, rounding, formatting, and inspection methods.

## Available Methods

| | | | |
|---|---|---|---|
| [abs](#abs) | [isBetween](#isbetween) | [lcm](#lcm) | [power](#power) |
| [add](#add) | [isEven](#iseven) | [magnitude](#magnitude) | [roundDown](#rounddown) |
| [ceil](#ceil) | [isFloat](#isfloat) | [make](#make) | [roundUp](#roundup) |
| [clamp](#clamp) | [isInteger](#isinteger) | [minus](#minus) | [sign](#sign) |
| [divide](#divide) | [isNegative](#isnegative) | [modulo](#modulo) | [sqrt](#sqrt) |
| [factorial](#factorial) | [isOdd](#isodd) | [multiply](#multiply) | [type](#type) |
| [factors](#factors) | [isPositive](#ispositive) | [ordinal](#ordinal) | [value](#value) |
| [floor](#floor) | [isPrime](#isprime) | [padLeft](#padleft) | [withOrdinal](#withordinal) |
| [gcd](#gcd) | [isZero](#iszero) | [padRight](#padright) | [wrap](#wrap) |

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

### factorial
> Returns `Utility`

Get the factorial of the number. Throws `InvalidNumberException` for negative or non-integer values.
```php
echo (new Utility(5))->factorial()->value();
// 120
echo (new Utility(0))->factorial()->value();
// 1
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

### gcd
> Returns `Utility`

Get the greatest common divisor of the number and the given value. Throws `InvalidNumberException` if either value is not an integer.
```php
echo (new Utility(12))->gcd(8)->value();
// 4
echo (new Utility(54))->gcd(24)->value();
// 6
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

### isFloat
> Returns `bool`

Check if the number is a float.
```php
(new Utility(5.5))->isFloat();
// true
(new Utility(5))->isFloat();
// false
```

### isInteger
> Returns `bool`

Check if the number is an integer.
```php
(new Utility(5))->isInteger();
// true
(new Utility(5.5))->isInteger();
// false
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

### isPrime
> Returns `bool`

Check if the number is a prime number. Returns false for non-integers and values below 2.
```php
(new Utility(7))->isPrime();
// true
(new Utility(9))->isPrime();
// false
```

### isZero
> Returns `bool`

Check if the number is zero.
```php
(new Utility(0))->isZero();
// true
```

### lcm
> Returns `Utility`

Get the least common multiple of the number and the given value. Returns `0` if either value is zero. Throws `InvalidNumberException` if either value is not an integer.
```php
echo (new Utility(4))->lcm(6)->value();
// 12
echo (new Utility(21))->lcm(6)->value();
// 42
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

### sign
> Returns `Utility`

Get the sign of the number: `-1` if negative, `0` if zero, `1` if positive.
```php
echo (new Utility(5))->sign()->value();
// 1
echo (new Utility(-5))->sign()->value();
// -1
echo (new Utility(0))->sign()->value();
// 0
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
### wrap
> Returns `Utility`

Wrap the number around a half-open range `[min, max)`. Values that fall outside the range wrap around to the other side; a value equal to `max` wraps back to `min`. Throws `InvalidNumberException` if `min` is not less than `max`.
```php
echo (new Utility(105))->wrap(0, 100)->value();
// 5
echo (new Utility(-5))->wrap(0, 100)->value();
// 95
echo (new Utility(100))->wrap(0, 100)->value();
// 0
```
