<?php

namespace Dgame\Optional;

/**
 * Class NullObject
 * @package Dgame\Optional
 */
final class NullObject
{
    /**
     * @var NullObject
     */
    private static $instance;

    /**
     * NullObject constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return NullObject
     */
    public static function Instance(): NullObject
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $method
     * @param array  $args
     *
     * @return $this
     */
    public function __call(string $method, array $args)
    {
        return $this;
    }
}