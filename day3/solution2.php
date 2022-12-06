<?php

$total = 0;

$group = [];
foreach (file(dirname(__FILE__) . '/input.txt') as $rucksack) {
    $rucksack = trim($rucksack);

    $group[] = str_split($rucksack, 1);

    if (count($group) == 3) {
        $intersects = array_values(array_unique(array_intersect($group[0], $group[1], $group[2])));

        $ord = ord($intersects[0]);

        if ($ord >= 97 && $ord <= 122) { // ASCII a is 97, z is 122
            $total += ($ord - 97) + 1; // a is 1, z is 26
        } else if ($ord >= 65 && $ord <= 90) {  // ASCII A is 65, Z is 90
            $total += ($ord - 65) + 27; // A is 27, Z is 52
        }

        $group = [];
    }
}

echo PHP_EOL . 'Total - ' . $total . PHP_EOL;


