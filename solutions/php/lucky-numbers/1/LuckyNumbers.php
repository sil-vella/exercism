<?php

class LuckyNumbers
{
public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
{
    $number1 = (int) implode('', $digitsOfNumber1);
    $number2 = (int) implode('', $digitsOfNumber2);

    return $number1 + $number2;
}

    public function isPalindrome(int $number): bool
    {
        return $number == (int) strrev((string) $number);
    }

    public function validate(string $input): string
    {
        if ($input === '') {
            return 'Required field';
        }
    
        if ((int) $input <= 0) {
            return 'Must be a whole number larger than 0';
        }
    
        return '';
    }
}
