<?php

$totals = [];
$elf = [];
foreach (file(dirname(__FILE__) . '/input.txt') as $calories) {
    $calories = trim($calories);

    if (empty($calories)) {
        $totals[] = array_sum($elf);
        $elf = [];

        continue;
    }

    $elf[] = (int) $calories;
}

echo "Puzzle 1" . PHP_EOL;
echo max($totals) . PHP_EOL;

asort($totals, SORT_NUMERIC);

echo "Puzzle 2" . PHP_EOL;

echo array_sum(array_slice(array_reverse(array_values($totals)), offset: 0, length: 3));
