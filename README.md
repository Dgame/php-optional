# php-optional
Rust-like Optional-type for PHP 7

###example
```php
use Optional\Optional;

class FooBar
{
    public function foo()
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }
    public function bar()
    {
        print __METHOD__ . PHP_EOL;
        return $this;
    }
}

function getSome()
{
    $a = new FooBar();
    return Optional::Some($a);
}

function getNone()
{
    return Optional::None(FooBar::class);
}
```

#### Some-Object

```php
$some = getSome();

var_dump($some->isSome(FooBar::class));
var_dump($some->extends(FooBar::class));
var_dump($some->is(FooBar::class));
var_dump($some->isNone());
var_dump($some->getIdentifier());
var_dump($some->may(FooBar::class));
var_dump($some->unwrap());

$some->may(FooBar::class)->foo()->bar();
```

#### None
```php
$none = getNone();

var_dump($none->isSome(FooBar::class));
var_dump($none->extends(FooBar::class));
var_dump($none->is(FooBar::class));
var_dump($none->isNone());
var_dump($none->getIdentifier());
var_dump($none->may(FooBar::class));

try {
    $none->expect('Is this None?');
} catch (OptionalException $oe) {
    var_dump($oe->getMessage()); // 'Is this None?' <- Yes, it is :)
}

$none->may(FooBar::class)->foo()->bar();
```

#### Some-Value
```php
$some = Optional::Some(42);

var_dump($some->isSome('int'));
var_dump($some->isSome('float'));
var_dump($some->isSome('numeric'));
var_dump($some->isSome('scalar'));
var_dump($some->isSome('string'));
var_dump($some->isSome('bool'));
var_dump($some->isSome('array'));
var_dump($some->isNone());
var_dump($some->is('int'));
var_dump($some->is('float'));
var_dump($some->is('numeric'));
var_dump($some->is('scalar'));
var_dump($some->is('string'));
var_dump($some->is('bool'));
var_dump($some->is('array'));
var_dump($some->getIdentifier());
var_dump($some->may('int'));
var_dump($some->unwrap());
```
