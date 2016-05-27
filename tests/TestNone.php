<?php

require_once '../vendor/autoload.php';

use Optional\None;
use Optional\Optional;

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

    public function testIdentifier()
    {
        $this->assertEquals('Optional\None(FooBar)', $this->none->getIdentifier());
    }

    public function testExecution()
    {
        $this->assertEquals(null, $this->none->unwrap());
        $this->assertEquals('Optional\None', get_class($this->none->may(FooBar::class)));
        $this->assertInstanceOf('Optional\None', $this->none->may(FooBar::class)->foo()->bar());
    }
}