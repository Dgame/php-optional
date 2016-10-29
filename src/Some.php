<?php

namespace Dgame\Optional;

/**
 * Class Some
 * @package Dgame\Optional
 */
final class Some extends Optional
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Some constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param null|mixed $value
     *
     * @return bool
     */
    public function isSome(&$value = null) : bool
    {
        $value = $this->value;

        return true;
    }

    /**
     * @return mixed
     */
    public function assume()
    {
        return $this->unwrap();
    }

    /**
     * @return mixed
     */
    public function unwrap()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function default($value)
    {
        return $this->value;
    }

    /**
     * @param callable $callback
     *
     * @return Optional
     */
    public function ensure(callable $callback) : Optional
    {
        if ($callback($this->value)) {
            return $this;
        }

        return None::Instance();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return sprintf('Some(%s)', var_export($this->value, true));
    }
}