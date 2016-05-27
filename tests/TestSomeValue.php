<?php

require_once '../vendor/autoload.php';

use Optional\Optional;
use Optional\SomeValue;

final class TestSomeValue extends PHPUnit_Framework_TestCase
{
    /**
     * @var SomeValue
     */
    private $some = null;

    protected function setUp()
    {
        $this->some = Optional::Some(42);
    }

    public function testIsSome()
    {
        $this->assertTrue($this->some->isSome('int'));
        $this->assertTrue($this->some->isSome('numeric'));
        $this->assertTrue($this->some->isSome('scalar'));
        $this->assertTrue($this->some->is('int'));

        $this->assertFalse($this->some->isSome('float'));
        $this->assertFalse($this->some->isSome('string'));
        $this->assertFalse($this->some->extends('numeric'));
        $this->assertFalse($this->some->isNone());
    }

    public function testIdentifier()
    {
        $this->assertEquals('Optional\SomeValue(int)', $this->some->getIdentifier());
    }

    public function testExecution()
    {
        $this->assertNotNull($this->some->unwrap());
        $this->assertEquals(42, $this->some->unwrap());
        $this->assertEquals(42, $this->some->may('int'));
        $this->assertEquals('Optional\None', get_class($this->some->may('float')));
        $this->assertEquals('Optional\None(float)', $this->some->may('float')->getIdentifier());
    }
}