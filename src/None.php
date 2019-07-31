<?php

namespace Dgame\Optional;

use Exception;
use RuntimeException;

/**
 * Class None
 * @package Dgame\Optional
 */
final class None extends OptionalBase
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
    public function unwrap(): void
    {
        throw new RuntimeException('Access to None value');
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
     * @param mixed $value
     *
     * @return bool
     */
    public function isEqualTo($value): bool
    {
        return $value == null;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isIdenticalTo($value): bool
    {
        return $value === null;
    }
}
