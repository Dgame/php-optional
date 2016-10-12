<?php

require_once '../vendor/autoload.php';

use Dgame\Optional\NullObject;
use PHPUnit\Framework\TestCase;
use function Dgame\Optional\maybe;
use function Dgame\Optional\none;
use function Dgame\Optional\some;

class OptionalTest extends TestCase
{
    public function testSome()
    {
        $some = some(42);
        $this->assertTrue($some->isSome());
        $this->assertEquals(42, $some->unwrap());
    }

    public function testSomeByRef()
    {
        $some = some(42);
        $this->assertTrue($some->isSome($value));
        $this->assertFalse($some->isNone());
        $this->assertEquals(42, $value);
    }

    public function testNone()
    {
        $none = none();
        $this->assertTrue($none->isNone());
        $this->assertFalse($none->isSome());
    }

    public function testNoneByRef()
    {
        $none = none();
        $this->assertTrue($none->isNone());
        $this->assertFalse($none->isSome($value));
        $this->assertNull($value);
    }

    public function testMaybe()
    {
        $maybe = maybe(null);
        $this->assertTrue($maybe->isNone());

        $maybe = maybe(false);
        $this->assertTrue($maybe->isNone());

        $maybe = maybe(42);
        $this->assertTrue($maybe->isSome());
        $this->assertEquals(42, $maybe->unwrap());
    }

    public function testChain()
    {
        $a = new class
        {
            public function test() : int
            {
                return 42;
            }
        };

        $some = some($a);
        $this->assertEquals(42, $some->unwrap()->test());
        $this->assertEquals(42, $some->assume()->test());

        $none = none();
        $this->assertSame(NullObject::Instance(), $none->assume()->test());
    }

    public function testEnsure()
    {
        $result = some(0)->ensure(function($value) {
            return $value > 0;
        });
        $this->assertTrue($result->isNone());
    }

    public function testEnforce()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('None');

        some(0)->enforce(function($value) {
            return $value > 0;
        }, new Exception('None'));
    }
}