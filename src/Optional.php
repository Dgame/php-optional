<?php

namespace Dgame\Optional;

use RuntimeException;
use TypeError;

/**
 * Class Optional
 * @package Dgame\Serde\Optional
 */
final class Optional
{
    /**
     * @var self
     */
    private static $none;
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var bool
     */
    private $isSome = false;

    /**
     * Optional constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param mixed $value
     *
     * @return Optional
     */
    public static function some($value): self
    {
        $self         = new self();
        $self->value  = $value;
        $self->isSome = true;

        return $self;
    }

    /**
     * @return Optional
     */
    public static function none(): self
    {
        if (self::$none === null) {
            self::$none = new self();
        }

        return self::$none;
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isSome(&$value = null): bool
    {
        $value = null;
        if ($this->isSome) {
            $value = $this->value;

            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isNone(): bool
    {
        return !$this->isSome;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if ($this->isNone()) {
            throw new RuntimeException('Invalid acces to invalid value');
        }

        return $this->value;
    }

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function getOr($default)
    {
        return $this->isSome($value) ? $value : $default;
    }

    /**
     * @param callable ...$closures
     *
     * @return bool
     */
    public function visit(callable ...$closures): bool
    {
        if ($this->isNone()) {
            return false;
        }

        foreach ($closures as $closure) {
            $opt = $this->tryVisit($closure);
            if ($opt->isSome()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param callable $closure
     *
     * @return Optional
     */
    private function tryVisit(callable $closure): self
    {
        try {
            $value = $closure($this->value);

            return self::some($value);
        } catch (TypeError $_) {
            return self::none();
        }
    }

    /**
     * @param callable $closure
     *
     * @return Optional
     */
    public function andThen(callable $closure): self
    {
        return $this->tryVisit($closure);
    }

    /**
     * @param callable $closure
     *
     * @return Optional
     */
    public function orElse(callable $closure): self
    {
        if ($this->isNone()) {
            return $this->tryVisit($closure);
        }

        return $this;
    }

    /**
     * @param Optional $opt
     *
     * @return Optional
     */
    public function or(self $opt): self
    {
        return $this->isNone() ? $opt : $this;
    }

    /**
     * @return mixed
     */
    public function drain()
    {
        $value = null;
        [$value, $this->value] = [$this->value, $value];
        $this->isSome = false;

        return $value;
    }
}
