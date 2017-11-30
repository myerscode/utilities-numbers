# Numbers Utilities
a helper class for the immutable, fluent use and manipulation of number values

## Install

You can install this package via composer:

``` bash
composer require myerscode/utilities-numbers
```

## Usage
Create a new instance of the utility class, passing in an initial value
```php
$u = new Utility(123);
echo $n->add(7)->minus(30)->divide(10);
// 10
echo $n;
// 123

$n = Utility::make(123);
echo $n->add(7)->minus(30)->divide(10);
// 10
echo $n;
// 123
```

### Add
Add a number
```php
echo (new Utility(5))->add(10);
// 20
```

### Ceil
Round up the number using ceil
```php
echo (new Utility(4.3))->ceil();
// 5
```

### Divide
Divide the original by the passed value
```php
echo (new Utility(25))->divide(5);
// 1
```

### Floor
Round down the value using floor
```php
echo (new Utility(4.3))->floor();
// 4
```

### Magnitude
Get the order of magnitude of the number
```php
echo (new Utility(1000))->magnitude();
// 3
```

### Minus
Minus a value from the number
```php
echo (new Utility(14))->minus(7);
// 7
```

### Multiply
Multiply the number
```php
echo (new Utility(7))->multiply(7);
// 49
```

### Ordinal
Get the ordinal version of a number (st, nd, nd, th)
```php
echo (new Utility(1))->ordinal(); 
// st
```

### Power
Power the number by a given exponent
```php
echo (new Utility(125))->ordinal(3); 
// 125
```

### Round Down
Round down the number to a given precision
```php
$n = new Utility(4.3);
echo $n->roundDown(); 
// 4
$n = new Utility(9.99);
echo $n->roundDown(); 
// 10
$n = new Utility(4.2345);
echo $n->roundDown(2); 
// 4.23
```

### Round Up
Round up the number to a given precision
```php
$n = new Utility(4.3);
echo $n->roundUp(); 
// 4
$n = new Utility(4.5);
echo $n->roundUp(); 
// 5
$n = new Utility(4.2345);
echo $n->roundUp(3); 
// 4.235
```

### Type
Get the type name of the current value
```php
echo (new Utility(7))->type(); 
// int
echo (new Utility(4.9))->type(); 
// float
```

### With Ordinal
Get the number with its ordinal (st, nd, nd, th)
```php
$n = new Utility(1);
echo $n->withOrdinal(); 
// 1st
$n = new Utility(2);
echo $n->withOrdinal(' '); 
// 2 nd
```
