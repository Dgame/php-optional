<?php

namespace Optional;

/**
 * Class None
 * @package Optional
 */
final class None extends Optional
{
    /**
     * @var None[]
     */
    private static $instances = [];
    /**
     * @var null|string
     */
    private $class = null;

    /**
     * None constructor.
     *
     * @param string|null $class
     */
    private function __construct(string $class = null)
    {
        if ($class !== null && !class_exists($class)) {
            throw new OptionalException('Eine Klasse mit dem Namen ' . $class . ' existiert nicht');
        }

        $this->class = $class;
    }

    /**
     * @param string|null $class
     *
     * @return None
     */
    public static function Of(string $class = null)
    {
        if ($class === null) {
            $class = None::class;
        }

        if (!array_key_exists($class, self::$instances)) {
            self::$instances[$class] = new self($class);
        }

        return self::$instances[$class];
    }

    /**
     * @param string $name
     * @param array  $args
     *
     * @return $this
     */
    public function __call(string $name, array $args)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        if ($this->class !== null) {
            return sprintf('%s(%s)', self::class, $this->class);
        }

        return self::class;
    }

    /**
     * @return bool
     */
    public function isNone()
    {
        return true;
    }
}
