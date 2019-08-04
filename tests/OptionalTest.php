<?php

namespace Dgame\Optional\Test;

use PHPUnit\Framework\TestCase;

use Dgame\Optional\Optional;

class OptionalTest extends TestCase
{
    public function testSome(): void
    {
        $some = Optional::some(42);
        $this->assertTrue($some->isSome());
        $this->assertEquals(42, $some->get());
    }

    public function testSomeByRef(): void
    {
        $some = Optional::some(42);
        $this->assertTrue($some->isSome($value));
        $this->assertFalse($some->isNone());
        $this->assertEquals(42, $value);
    }

    public function testNone(): void
    {
        $none = Optional::none();
        $this->assertTrue($none->isNone());
        $c = 42;
        $this->assertFalse($none->isSome($c));
        $this->assertNull($c);
    }

    public function testNoneByRef(): void
    {
        $none =  Optional::none();
        $this->assertTrue($none->isNone());
        $this->assertFalse($none->isSome($value));
        $this->assertNull($value);
    }

    public function testChain(): void
    {
        $a = new class() {
            public function test(): int
            {
                return 42;
            }
        };

        $some =  Optional::some($a);
        $this->assertEquals(42, $some->get()->test());
    }
}
