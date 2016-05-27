<?php

require_once 'vendor/autoload.php';

use Optional\Optional;

class A
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

print '<pre>';

$some = getSome();

var_dump($some->isSome(FooBar::class));
var_dump($some->extends(FooBar::class));
var_dump($some->is(FooBar::class));
var_dump($some->isNone());
var_dump($some->getIdentifier());
var_dump($some->may(FooBar::class));
var_dump($some->unwrap());

$some->may(FooBar::class)->foo()->bar();

print PHP_EOL . str_repeat('=', 50) . PHP_EOL;

$none = getNone();

var_dump($none->isSome(FooBar::class));
var_dump($none->extends(FooBar::class));
var_dump($none->is(FooBar::class));
var_dump($none->isNone());
var_dump($none->getIdentifier());
var_dump($none->may(FooBar::class));
var_dump($none->unwrap());

$none->may(FooBar::class)->foo()->bar();

print PHP_EOL . str_repeat('=', 50) . PHP_EOL;

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

print PHP_EOL . str_repeat('=', 50) . PHP_EOL;

$none = Optional::None();

var_dump($none->isSome('int'));
var_dump($none->isSome('float'));
var_dump($none->isSome('numeric'));
var_dump($none->isSome('scalar'));
var_dump($none->isSome('string'));
var_dump($none->isSome('bool'));
var_dump($none->isSome('array'));
var_dump($none->isNone());
var_dump($none->is('int'));
var_dump($none->is('float'));
var_dump($none->is('numeric'));
var_dump($none->is('scalar'));
var_dump($none->is('string'));
var_dump($none->is('bool'));
var_dump($none->is('array'));
var_dump($none->getIdentifier());
var_dump($none->may('int'));
var_dump($none->unwrap());


