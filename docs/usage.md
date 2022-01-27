# Utility Usage

Create an instance of the fluent interface by creating a new instance either via `new Utility($val)` or `Utility::make($val)`

```php
$util = new Utility(123);
echo $util->add(7)->minus(30)->divide(10);
// 10

// the original $util is unchanged
echo $n;
// 123

$n = Utility::make(123);
echo $n->add(7)->minus(30)->divide(10);
// 10

// the original $util is unchanged
echo $n;
// 123
```
