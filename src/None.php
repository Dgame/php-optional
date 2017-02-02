<?php

namespace Dgame\Optional;

use Exception;

/**
 * Class None
 * @package Dgame\Optional
 */
final class None extends AbstractOptional
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
     *
     */
    private function __clone()
    {
    }

    /**
     * @return None
     */
    public static function instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isSome(&$value = null): bool
    {
        $value = null;

        return false;
    }

    /**
     * @throws Exception
     */
    public function unwrap()
    {
        throw new Exception('Access to None value');
    }

    /**
     * @param callable $callback
     *
     * @return OptionalInterface
     */
    public function ensure(callable $callback): OptionalInterface
    {
        return $this;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function isEqualTo($value): bool
    {
        return $value == null;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function isIdenticalTo($value): bool
    {
        return $value === null;
    }
}