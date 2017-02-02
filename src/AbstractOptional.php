<?php

namespace Dgame\Optional;

/**
 * Class AbstractOptional
 * @package Dgame\Optional
 */
abstract class AbstractOptional implements OptionalInterface
{
    /**
     * @return bool
     */
    final public function isNone(): bool
    {
        return !$this->isSome();
    }

    /**
     * @param $default
     *
     * @return mixed
     */
    final public function default($default)
    {
        return $this->isSome($value) ? $value : $default;
    }

    /**
     * @param callable $callback
     */
    final public function do(callable $callback)
    {
        if ($this->isSome($value)) {
            $callback($value);
        }
    }

    /**
     * @param callable $callback
     *
     * @return callable
     */
    public function fetch(callable $callback): callable
    {
        if ($this->isSome($value)) {
            return $callback($value);
        }

        return null;
    }

    /**
     * @return OptionalInterface
     */
    final public function ensureNotFalse(): OptionalInterface
    {
        return $this->ensure(function ($value): bool {
            return $value !== false;
        });
    }

    /**
     * @param $value
     *
     * @return bool
     */
    final public function isNotEqualTo($value): bool
    {
        return !$this->isEqualTo($value);
    }

    /**
     * @param $value
     *
     * @return bool
     */
    final public function isNotIdenticalTo($value): bool
    {
        return !$this->isIdenticalTo($value);
    }
}