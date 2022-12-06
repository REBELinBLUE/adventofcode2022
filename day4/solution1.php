<?php

function covers(array $first, array $second): bool {
    // Create arrays with ranges, for example 1-3 would create an array with 1, 2, 3
    $assignments1 = range((int) $first[0], (int) $first[1]);
    $assignments2 = range((int) $second[0], (int) $second[1]);

    $diff = array_diff($assignments1, $assignments2);

    return (count($diff) === 0);
}

$total = 0;
foreach (file(dirname(__FILE__) . '/input.txt') as $assignments) {
    $assignments = explode(',', trim($assignments));

    // Get the start and end of each assignment
    $assignments1 = explode('-', $assignments[0]);
    $assignments2 = explode('-', $assignments[1]);

    // Compare the first assignment array to the second, if there are no difference then the second is fully within the first
    if (covers($assignments1, $assignments2)) {
        $total += 1;
        continue;
    }

    // Compare the second assignment array to the first, if there are no difference then the first is fully within the second
    $total += covers($assignments2, $assignments1);
}

echo PHP_EOL . 'Total - ' . $total . PHP_EOL;

