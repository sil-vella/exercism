<?php

class PizzaPi
{
    public function calculateDoughRequirement($pizzas, $persons)
    {
        $grams = $pizzas * (( $persons * 20) + 200);
        return $grams;
    }

    public function calculateSauceRequirement($pizzas, $sause_can_volume)
    {
        $cans = ($pizzas * 125) / $sause_can_volume;
        return $cans;
    }

    public function calculateCheeseCubeCoverage($cheese_dimension, $thickness, $diameter)
    {
        $pizzas = ($cheese_dimension ** 3) / ($thickness * pi() * $diameter);
        return $pizzas;
    }

    public function calculateLeftOverSlices($pizzas, $friends)
    {
        $slices = $pizzas % $friends;
        return $slices;
    }
}
