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
    private $type = null;

    /**
     * None constructor.
     *
     * @param string|null $type
     */
    private function __construct(string $type = null)
    {
        $this->type = $type;
    }

    /**
     * @param string|null $type
     *
     * @return None
     */
    public static function Of(string $type = null) : None
    {
        $type = $type === null ? 'None' : Type::Alias($type);

        if (!array_key_exists($type, self::$instances)) {
            self::$instances[$type] = new self($type);
        }

        return self::$instances[$type];
    }

    /**
     * @param string $name
     * @param array  $args
     *
     * @return $this
     */
    public function __call(string $name, array $args) : None
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier() : string
    {
        if ($this->type !== null) {
            return sprintf('%s(%s)', self::class, $this->type);
        }

        return self::class;
    }

    /**
     * @return bool
     */
    public function isNone() : bool
    {
        return true;
    }

    /**
     * @param string $type
     *
     * @return mixed
     */
    public function may(string $type)
    {
        return $this;
    }

    /**
     * @param string $msg
     *
     * @throws OptionalException
     */
    public function expect(string $msg)
    {
        throw new OptionalException($msg);
    }

    /**
     * @throws OptionalException
     */
    public function unwrap()
    {
        throw new OptionalException('You tried to unwrap ' . self::class);
    }
}
