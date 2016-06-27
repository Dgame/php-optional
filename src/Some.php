<?php

namespace Dgame\Iterator\Optional;

/**
 * Class Some
 * @package Dgame\Iterator\Optional
 */
final class Some extends Optional
{
    /**
     * @var mixed
     */
    private $value = null;

    /**
     * @param $value
     *
     * @return bool
     */
    public static function Verify($value) : bool
    {
        return $value !== null && $value !== false;
    }

    /**
     * Some constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        if (!self::Verify($value)) {
            throw new \Exception('That is not a valid value');
        }

        $this->value = $value;
    }

    /**
     * @param null|mixed $some
     *
     * @return bool
     */
    public function isSome(&$some = null) : bool
    {
        if (func_num_args() !== 0) {
            $some = $this->value;
        }

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