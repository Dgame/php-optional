<?php

require_once '../vendor/autoload.php';

use Optional\Optional;
use Optional\SomeObject;

final class TestSomeObject extends PHPUnit_Framework_TestCase
{
    /**
     * @var SomeObject
     */
    private $some = null;

    protected function setUp()
    {
        $this->some = Optional::Some(new FooBar());
    }

    public function testIsSome()
    {
        $this->assertTrue($this->some->isSome(FooBar::class));
        $this->assertTrue($this->some->is(FooBar::class));
        
        $this->assertFalse($this->some->extends(FooBar::class));
        $this->assertFalse($this->some->isNone());
    }

    public function testIdentifier()
    {
        $this->assertEquals('Optional\SomeObject(FooBar)', $this->some->getIdentifier());
    }

    public function testExecution()
    {
        $this->assertNotNull($this->some->unwrap());
        $this->assertEquals(FooBar::class, get_class($this->some->unwrap()));
        $this->assertEquals(FooBar::class, get_class($this->some->may(FooBar::class)));
        $this->assertEquals(42, $this->some->may(FooBar::class)->foo()->bar());
    }
}