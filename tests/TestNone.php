<?php

require_once '../vendor/autoload.php';

use Optional\None;
use Optional\Optional;
use Optional\OptionalException;

final class TestNone extends PHPUnit_Framework_TestCase
{
    /**
     * @var None
     */
    private $none = null;

    protected function setUp()
    {
        $this->none = Optional::None(FooBar::class);
    }

    public function testIsSome()
    {
        $this->assertFalse($this->none->isSome(FooBar::class));
        $this->assertFalse($this->none->is(FooBar::class));
        $this->assertFalse($this->none->extends(FooBar::class));

        $this->assertTrue($this->none->isNone());
    }

    public function testExpect()
    {
        $this->expectException(OptionalException::class);
        $this->expectExceptionMessage('That is None?!');

        $this->none->expect('That is None?!');
    }

    public function testUnwrap()
    {
        $this->expectException(OptionalException::class);
        $this->expectExceptionMessage('You tried to unwrap ' . None::class);

        $this->none->unwrap();
    }

    public function testIdentifier()
    {
        $this->assertEquals('Optional\None(FooBar)', $this->none->getIdentifier());
    }

    public function testExecution()
    {
        $this->assertEquals('Optional\None', get_class($this->none->may(FooBar::class)));
        $this->assertInstanceOf('Optional\None', $this->none->may(FooBar::class)->foo()->bar());
    }
}