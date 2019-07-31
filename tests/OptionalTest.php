<?php

use function Dgame\Optional\maybe;
use function Dgame\Optional\none;
use function Dgame\Optional\some;
use PHPUnit\Framework\TestCase;

class OptionalTest extends TestCase
{
    public function testSome(): void
    {
        $some = some(42);
        $this->assertTrue($some->isSome());
        $this->assertEquals(42, $some->unwrap());
    }

    public function testSomeByRef(): void
    {
        $some = some(42);
        $this->assertTrue($some->isSome($value));
        $this->assertFalse($some->isNone());
        $this->assertEquals(42, $value);
    }

    public function testNone(): void
    {
        $none = none();
        $this->assertTrue($none->isNone());
        $c = 42;
        $this->assertFalse($none->isSome($c));
        $this->assertNull($c);
    }

    public function testNoneByRef(): void
    {
        $none = none();
        $this->assertTrue($none->isNone());
        $this->assertFalse($none->isSome($value));
        $this->assertNull($value);
    }

    public function testMaybe(): void
    {
        $maybe = maybe(null);
        $this->assertTrue($maybe->isNone());

        $maybe = maybe(false)->ensureNotFalse();
        $this->assertTrue($maybe->isNone());

        $maybe = maybe(42);
        $this->assertTrue($maybe->isSome());
        $this->assertEquals(42, $maybe->unwrap());
    }

    public function testChain(): void
    {
        $a = new class() {
            public function test(): int
            {
                return 42;
            }
        };

        $some = some($a);
        $this->assertEquals(42, $some->unwrap()->test());
    }

    public function testEnsure(): void
    {
        $result = some(0)->ensure(function ($value) {
            return $value > 0;
        });
        $this->assertTrue($result->isNone());
        $result = maybe(null)->ensure(function ($value) {
            return $value > 0;
        });
        $this->assertTrue($result->isNone());
    }
}