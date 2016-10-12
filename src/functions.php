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
 * @param $value
 *
 * @return Optional
 */
function maybe($value): Optional
{
    if ($value !== false && $value !== null) {
        return some($value);
    }

    return none();
}