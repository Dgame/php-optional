<?php

namespace Dgame\Optional;

/**
 * Interface OptionalInterface
 * @package Dgame\Optional
 */
interface OptionalInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function isSome(&$value = null): bool;

    /**
     * @return bool
     */
    public function isNone(): bool;

    /**
     * @return mixed
     */
    public function unwrap();

    /**
     * @param $value
     *
     * @return mixed
     */
    public function default($value);

    /**
     * @param callable $callback
     *
     * @return OptionalInterface
     */
    public function ensure(callable $callback): self;

    /**
     * @return OptionalInterface
     */
    public function ensureNotFalse(): self;

    /**
     * @param $value
     *
     * @return bool
     */
    public function isEqualTo($value): bool;

    /**
     * @param $value
     *
     * @return bool
     */
    public function isNotEqualTo($value): bool;

    /**
     * @param $value
     *
     * @return bool
     */
    public function isIdenticalTo($value): bool;

    /**
     * @param $value
     *
     * @return bool
     */
    public function isNotIdenticalTo($value): bool;

    /**
     * @param callable $callback
     */
    public function do(callable $callback);
}