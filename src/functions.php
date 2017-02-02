<?php

namespace Dgame\Optional;

/**
 * @param $value
 *
 * @return Some
 */
function some($value): Some
{
    return new Some($value);
}

/**
 * @return None
 */
function none(): None
{
    return None::instance();
}

/**
 * @param $value
 *
 * @return OptionalInterface
 */
function maybe($value): OptionalInterface
{
    return $value !== null ? some($value) : none();
}