<?php

namespace Dgame\Optional;

/**
 * @param mixed $value
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
 * @param mixed $value
 *
 * @return Optional
 */
function maybe($value): Optional
{
    return $value !== null ? some($value) : none();
}
