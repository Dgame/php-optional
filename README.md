# php-optional

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dgame/php-optional/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dgame/php-optional/?branch=master)

Rust-like Optional-type for PHP 7

### Some - a valid Value
```php
$some = some(42);
$this->assertTrue($some->isSome());
$this->assertEquals(42, $some->unwrap());
```

### Some with argument unpacking
```php
$some = some(42);
$this->assertTrue($some->isSome($value));
$this->assertFalse($some->isNone());
$this->assertEquals(42, $value);
```

### None - an invalid value
```php
$none = none();
$this->assertTrue($none->isNone());
$this->assertFalse($none->isSome());
```

### None with argument unpacking
```php
$none = none();
$this->assertTrue($none->isNone());
$this->assertFalse($none->isSome($value));
$this->assertNull($value);
```

### Maybe - decides for you if your value is a `Some` or a `None`
```php
$maybe = maybe(null);
$this->assertTrue($maybe->isNone());
$maybe = maybe(42);
$this->assertTrue($maybe->isSome());
$this->assertEquals(42, $maybe->unwrap());
```

### Ensure that a condition is fulfilled
```php
$result = some(0)->ensure(function($value) {
    return $value > 0;
});
$this->assertTrue($result->isNone());
```

### Enforce that a condition is fulfilled
```php
$this->expectException(Exception::class);
$this->expectExceptionMessage('None');
some(0)->enforce(function($value) {
    return $value > 0;
}, new Exception('None'));
```
