<?php

namespace Optional;

/**
 * Class Some
 * @package Optional
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
    public function getIdentifier()
    {
        return sprintf('%s(%s)', self::class, $this->type);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function is(string $class)
    {
        return is_a($this->object, $class);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function extends(string $class)
    {
        return is_subclass_of($this->object, $class);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function isSome(string $class)
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

        return parent::may($class);
    }

    /**
     * @return object
     */
    public function unwrap()
    {
        return $this->object;
    }
}