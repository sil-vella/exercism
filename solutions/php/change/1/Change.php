<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

function findFewestCoins(array $coins, int $amount): array
{
    if ($amount < 0) {
        throw new InvalidArgumentException(
            'Cannot make change for negative value'
        );
    }

    if ($amount === 0) {
        return [];
    }

    if (min($coins) > $amount) {
        throw new InvalidArgumentException(
            'No coins small enough to make change'
        );
    }

    // $best[$value] stores the fewest coins needed for $value.
    $best = [
        0 => [],
    ];

    for ($value = 1; $value <= $amount; $value++) {
        foreach ($coins as $coin) {
            $remaining = $value - $coin;

            // This coin is too large or the remainder cannot be made.
            if ($remaining < 0 || !isset($best[$remaining])) {
                continue;
            }

            $candidate = $best[$remaining];
            $candidate[] = $coin;

            if (
                !isset($best[$value]) ||
                count($candidate) < count($best[$value])
            ) {
                $best[$value] = $candidate;
            }
        }
    }

    if (!isset($best[$amount])) {
        throw new InvalidArgumentException(
            'No combination can add up to target'
        );
    }

    sort($best[$amount]);

    return $best[$amount];
}
