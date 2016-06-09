<?php

namespace Dgame\Optional;

/**
 * Class Type
 * @package Dgame\Optional
 */
final class Type
{
    /**
     * @var callable[]
     */
    private static $Validators = [
        'int'      => 'is_integer',
        'float'    => 'is_float',
        'numeric'  => 'is_numeric',
        'scalar'   => 'is_scalar',
        'resource' => 'is_resource',
        'string'   => 'is_string',
        'bool'     => 'is_bool',
        'array'    => 'is_array',
        'object'   => 'is_object',
        'null'     => 'is_null',
        'callable' => 'is_callable',
    ];

    /**
     * @var array
     */
    private static $Alias = [
        'integer' => 'int',
        'double'  => 'float',
        'real'    => 'float',
        'boolean' => 'bool',
    ];

    /**
     * @var Type[]
     */
    private static $instances = [];

    /**
     * @var null|string
     */
    private $type = null;

    /**
     * TypeValidator constructor.
     *
     * @param string $type
     */
    private function __construct(string $type)
    {
        if (!array_key_exists($type, self::$Validators)) {
            throw new \Exception(sprintf('Type "%s" ist nicht definiert', $type));
        }

        $this->type = $type;
    }

    /**
     * @param string $type
     *
     * @return Type
     */
    public static function Instance(string $type) : Type
    {
        $type = self::Alias($type);
        if (!array_key_exists($type, self::$instances)) {
            self::$instances[$type] = new self($type);
        }

        return self::$instances[$type];
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public static function Alias(string $type) : string
    {
        if (array_key_exists($type, self::$Alias)) {
            return self::$Alias[$type];
        }

        return $type;
    }

    /**
     * @return callable
     */
    public function getValidator() : callable
    {
        return self::$Validators[$this->type];
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function has($value) : bool
    {
        return call_user_func($this->getValidator(), $value);
    }
}