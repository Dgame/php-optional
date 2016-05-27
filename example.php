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
    $a = new A();

    return Optional::Some($a);
}
function getNone()
{
    return Optional::None(A::class);
}

$some = getSome();

var_dump($some->isSome(A::class));
var_dump($some->extends(A::class));
var_dump($some->is(A::class));
var_dump($some->isNone());
var_dump($some->getIdentifier());
var_dump($some->may(A::class));
var_dump($some->unwrap());

$some->may(A::class)->foo()->bar();

$none = getNone();

var_dump($none->isSome(A::class));
var_dump($none->extends(A::class));
var_dump($none->is(A::class));
var_dump($none->isNone());
var_dump($none->getIdentifier());
var_dump($none->may(A::class));
var_dump($none->unwrap());

$none->may(A::class)->foo()->bar();