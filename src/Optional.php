<?php

namespace Optional;

/**
 * Class Optional
 * @package Optional
 */
abstract class Optional
{
    /**
     * @param object $object
     *
     * @return Some
     */
    public static function Some($object)
    {
        return new Some($object);
    }

    /**
     * @param string|null $class
     *
     * @return None
     */
    public static function None(string $class = null)
    {
        return None::Of($class);
    }

    /**
     * @return mixed
     */
    abstract public function getIdentifier();

    /**
     * @param string $class
     *
     * @return bool
     */
    public function is(string $class)
    {
        return false;
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function extends(string $class)
    {
        return false;
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function isSome(string $class)
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isNone()
    {
        return false;
    }

    /**
     * @param string $class
     *
     * @throws OptionalException
     */
    public function as(string $class)
    {
        throw new OptionalException(sprintf('Optional: %s ist nicht %s', $this->getIdentifier(), $class));
    }

    /**
     * @param string $class
     *
     * @return None
     */
    public function may(string $class)
    {
        return self::None($class);
    }

    /**
     * @return null
     */
    public function unwrap()
    {
        return null;
    }
}