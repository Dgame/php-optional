<?php

namespace Dgame\Optional;

/**
 * Class Some
 * @package Dgame\Optional
 */
final class Some extends OptionalBase
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Some constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isSome(&$value = null): bool
    {
        $value = $this->value;

        return true;
    }

    /**
     * @return mixed
     */
    public function unwrap()
    {
        return $this->value;
    }

    /**
     * @param callable $callback
     *
     * @return Optional
     */
    public function ensure(callable $callback): Optional
    {
        return $callback($this->value) ? $this : None::instance();
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isEqualTo($value): bool
    {
        return $value == $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isIdenticalTo($value): bool
    {
        return $value === $this->value;
    }
}
