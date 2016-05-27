<?php

namespace Optional;

/**
 * Class SomeFactory
 * @package Optional
 */
final class SomeFactory
{
    /**
     * @param $value
     *
     * @return SomeObject|SomeValue
     */
    public static function MakeSome($value)
    {
        if (is_object($value)) {
            return new SomeObject($value);
        }

        return new SomeValue($value);
    }
}