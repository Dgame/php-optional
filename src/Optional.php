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
    public static function None(string $type = null) : None
    {
        return None::Of($type);
    }

    /**
     * @return string
     */
    abstract public function getIdentifier() : string;

    /**
     * @param string $type
     *
     * @return bool
     */
    public function is(string $type) : bool
    {
        return false;
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function extends(string $class) : bool
    {
        return false;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function isSome(string $type) : bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isNone() : bool
    {
        return false;
    }

    /**
     * @param string $type
     *
     * @return mixed
     */
    abstract public function may(string $type);

    /**
     * @param string $msg
     *
     * @return mixed
     */
    abstract public function expect(string $msg);

    /**
     * @return mixed
     */
    abstract public function unwrap();
}