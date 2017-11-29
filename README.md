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
add a number
```php
$n = new Utility(5);
$n->add(5);
echo $n; 
// 10
$n->add(10);
// 20
```

### Ceil
round up the number using ceil
```php
$n = new Utility(4.3);
echo $n->ceil();
// 5
```

### Divide
divide the original by the passed value
```php
$n = new Utility(25);
echo $n->divide(5);
// 1
```

### Floor
round down the value using floor
```php
$n = new Utility(4.3);
echo $n->floor();
// 4
```

### Magnitude
get the order of magnitude of the number
```php
$n = new Utility(1000);
echo $n->magnitude();
// 3
```

### Minus
minus a value
```php
$n = new Utility(14);
echo $n->minus(7);
// 7
```

### Multiply
multiply the value
```php
$n = new Utility(7);
echo $n->multiply(7);
// 49
```

### Ordinal
get the ordinal version of a number (st, nd, nd, th)
```php
$n = new Utility(1);
echo $n->ordinal(); 
// st
```

### Round Down
round down the number to a given precision
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
$n = new Utility(7);
echo $n->roundUp(); 
// int
$n = new Utility(4.9);
echo $n->roundUp(); 
// float
```
### With Ordinal
get the ordinal version of a number (st, nd, nd, th)
```php
$n = new Utility(1);
echo $n->withOrdinal(); 
// 1st
$n = new Utility(2);
echo $n->withOrdinal(' '); 
// 2 nd
```
