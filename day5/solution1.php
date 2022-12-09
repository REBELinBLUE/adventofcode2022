<?php

$stackData = array_slice(file(dirname(__FILE__) . '/input.txt'), 0, 8);
$movesData = array_slice(file(dirname(__FILE__) . '/input.txt'), 10);

$stacks = [];

// Build an array of stacks
foreach ($stackData as $line) {
    foreach (str_split($line,4) as $stackNum => $crate) {
        if (!array_key_exists($stackNum + 1, $stacks)) {
            $stacks[$stackNum + 1] = [];
        }

        $crate = trim($crate);
        if (!empty($crate)) {
            $stacks[$stackNum + 1][] = substr($crate, 1, -1);
        }
    }
}

// Stacks are in the wrong order, i.e. 0 is the top, so reverse them
foreach ($stacks as $num => $stack) {
    $stacks[$num] = array_reverse($stack);
}

foreach ($movesData as $linenum => $move) {
    preg_match('/move (\d+) from (\d) to (\d)/', $move, $moves);

    list (, $total, $from, $to) = $moves;

    // Could do this better slicing the array, reversing it and prepending it
    for ($i = 0; $i < $total; $i++) {
        $crate = array_pop($stacks[$from]);

        /*
         * these lines are causing problems, there are 13 in stack 6, move them and then try to move another 1
         *
         * move 13 from 6 to 1
         * move 1 from 6 to 3
         *
         * with array_pop and push these cause an empty item to be pushed onto the new stack
         * but as more items are added afterwards it doesn't cause a problem with the final result
         */
        if (empty($crate)) {
            continue;
        }

        array_push($stacks[$to], $crate);
    }
}


echo PHP_EOL . 'Solution' . PHP_EOL;

foreach ($stacks as $stack) {
    echo end($stack);
}

// QPJPLRFP
