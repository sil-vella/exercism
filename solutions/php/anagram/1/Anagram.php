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

function detectAnagrams(string $word, array $possibleAnagrams): array
{
    $normalizedWord = strtolower($word);
    $wordLetters = str_split($normalizedWord);
    sort($wordLetters);

    $correctAnagrams = [];

    foreach ($possibleAnagrams as $possibleAnagram) {
        $normalizedAnagram = strtolower($possibleAnagram);

        // A word is not an anagram of itself.
        if ($normalizedWord === $normalizedAnagram) {
            continue;
        }

        $anagramLetters = str_split($normalizedAnagram);
        sort($anagramLetters);

        if ($wordLetters === $anagramLetters) {
            $correctAnagrams[] = $possibleAnagram;
        }
    }

    return $correctAnagrams;
}