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
    return None::Instance();
}

/**
 * @param          $value
 * @param callable $callback
 *
 * @return Optional
 */
function maybe($value, callable $callback = null): Optional
{
    $callback = $callback ?? 'Dgame\Optional\verify';
    if ($callback($value)) {
        return some($value);
    }

    return none();
}

/**
 * @param $value
 *
 * @return bool
 */
function verify($value): bool
{
    return $value !== false && $value !== null;
}