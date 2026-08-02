<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        $name = trim($name);
        return substr($name, 0, 1);
    }

    public function initial(string $name): string
    {
        return $this->firstLetter(strtoupper($name)) . '.';
    }

    public function initials(string $name): string
    {
        $name = explode(' ', $name);
        $initLetters = [];
        foreach ($name as $n) {
            $initLetters[] = $this->initial($n);
        }
        return implode(' ', $initLetters);
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        $pair = $this->initials($sweetheart_a) . '  +  ' . $this->initials($sweetheart_b);

        return <<<HEART
     ******       ******
   **      **   **      **
 **         ** **         **
**            *            **
**                         **
**     $pair     **
 **                       **
   **                   **
     **               **
       **           **
         **       **
           **   **
             ***
              *
HEART;
    }
}
