<?php

namespace Dgame\Optional;

/**
 * Class Some
 * @package Dgame\Optional
 */
final class SomeObject extends Optional
{
    /**
     * @var object
     */
    private $object = null;
    /**
     * @var null|string
     */
    private $type = null;

    /**
     * Some constructor.
     *
     * @param object $object
     */
    public function __construct($object)
    {
        if (!is_object($object)) {
            throw new OptionalException('Some erwartet ein valides Objekt');
        }

        $this->object = $object;
        $this->type   = get_class($object);
    }

    /**
     * @return string
     */
    public function getIdentifier() : string
    {
        return sprintf('%s(%s)', self::class, $this->type);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function is(string $class) : bool
    {
        return is_a($this->object, $class);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function extends(string $class) : bool
    {
        return is_subclass_of($this->object, $class);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function isSome(string $class) : bool
    {
        return $this->is($class) || $this->extends($class);
    }

    /**
     * @param string $class
     *
     * @return object|None
     */
    public function may(string $class)
    {
        if ($this->isSome($class)) {
            return $this->unwrap();
        }

        return None::Of($class);
    }

    /**
     * @param string $msg
     *
     * @return object
     */
    public function expect(string $msg)
    {
        return $this->unwrap();
    }

    /**
     * @return object
     */
    public function unwrap()
    {
        return $this->object;
    }
}