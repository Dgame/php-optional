<?php

namespace Dgame\Optional;

/**
 * Class None
 * @package Dgame\Optional
 */
final class None extends Optional
{
    /**
     * @var None
     */
    private static $instance;

    /**
     * None constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return None
     */
    public static function Instance(): None
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return bool
     */
    public function isNone(): bool
    {
        return true;
    }

    /**
     * @return NullObject
     */
    public function assume()
    {
        return NullObject::Instance();
    }

    /**
     * @throws \Exception
     */
    public function unwrap()
    {
        throw new \Exception('No value');
    }

    /**
     * @param callable $callback
     *
     * @return Optional
     */
    public function ensure(callable $callback): Optional
    {
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'None';
    }
}