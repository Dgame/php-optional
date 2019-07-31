<?php

namespace Dgame\Optional;

/**
 * Class OptionalBase
 * @package Dgame\Optional
 */
abstract class OptionalBase implements Optional
{
    /**
     * @return bool
     */
    final public function isNone(): bool
    {
        return !$this->isSome();
    }

    /**
     * @param mixed $default
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
    final public function do(callable $callback): void
    {
        if ($this->isSome($value)) {
            $callback($value);
        }
    }

    /**
     * @return Optional
     */
    final public function ensureNotFalse(): Optional
    {
        return $this->ensure(static function ($value): bool {
            return $value !== false;
        });
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    final public function isNotEqualTo($value): bool
    {
        return !$this->isEqualTo($value);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    final public function isNotIdenticalTo($value): bool
    {
        return !$this->isIdenticalTo($value);
    }
}
