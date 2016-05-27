<?php

namespace Optional;

/**
 * Class SomeValue
 * @package Optional
 */
final class SomeValue extends Optional
{
    /**
     * @var mixed
     */
    private $value = null;
    /**
     * @var null|string
     */
    private $type = null;

    /**
     * SomeValue constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
        $this->type  = Type::Alias(gettype($value));
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return sprintf('%s(%s)', self::class, $this->type);
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function is(string $type)
    {
        return $this->type === Type::Alias($type);
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function isSome(string $type)
    {
        return Type::Instance($type)->has($this->value);
    }

    /**
     * @param string $type
     *
     * @return object|None
     */
    public function may(string $type)
    {
        if ($this->isSome($type)) {
            return $this->unwrap();
        }

        return parent::may($type);
    }

    /**
     * @return mixed
     */
    public function unwrap()
    {
        return $this->value;
    }
}