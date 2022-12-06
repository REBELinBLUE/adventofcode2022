<?php

function covers(array $first, array $second): bool {
    // Create arrays with ranges, for example 1-3 would create an array with 1, 2, 3
    $assignments1 = range((int) $first[0], (int) $first[1]);
    $assignments2 = range((int) $second[0], (int) $second[1]);

    $intersect = array_intersect($assignments1, $assignments2);

    return (count($intersect) > 0);
}

$total = 0;
foreach (file(dirname(__FILE__) . '/input.txt') as $assignments) {
    $assignments = explode(',', trim($assignments));

    // Get the start and end of each assignment
    $assignments1 = explode('-', $assignments[0]);
    $assignments2 = explode('-', $assignments[1]);

    // Compare the first assignment array to the second, if there are intersections then they cover one another
    $total += covers($assignments1, $assignments2);
}

echo PHP_EOL . 'Total - ' . $total . PHP_EOL;

