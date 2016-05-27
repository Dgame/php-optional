<?php

namespace Optional;

/**
 * Class Optional
 * @package Optional
 */
abstract class Optional
{
    /**
     * @param $value
     *
     * @return SomeObject|SomeValue
     */
    public static function Some($value)
    {
        return SomeFactory::MakeSome($value);
    }

    /**
     * @param string|null $type
     *
     * @return None
     */
    public static function None(string $type = null)
    {
        return None::Of($type);
    }

    /**
     * @return mixed
     */
    abstract public function getIdentifier();

    /**
     * @param string $type
     *
     * @return bool
     */
    public function is(string $type)
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
     * @param string $type
     *
     * @return bool
     */
    public function isSome(string $type)
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
     * @param string $type
     *
     * @return None
     */
    public function may(string $type)
    {
        return self::None($type);
    }

    /**
     * @return null
     */
    public function unwrap()
    {
        return null;
    }
}