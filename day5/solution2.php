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

foreach ($movesData as $move) {
    preg_match('/move (\d+) from (\d) to (\d)/', $move, $moves);

    list (, $toMove, $from, $to) = $moves;

    /*
     * these lines are causing problems, there are 13 in stack 6, move them and then try to move another 1
     *
     * move 13 from 6 to 1
     * move 1 from 6 to 3
     */
    if (count($stacks[$from]) >= $toMove) {
        $remaining = array_slice($stacks[$from], 0, 0 - $toMove);
        $moved = array_slice($stacks[$from], 0 - $toMove, $toMove);
    } else {
        // So move the whole stack
        $remaining = [];
        $moved = $stacks[$from];
    }


    $stacks[$from] = $remaining;
    $stacks[$to] = array_merge($stacks[$to], $moved);
}

echo PHP_EOL . 'Solution' . PHP_EOL;

foreach ($stacks as $stack) {
    echo end($stack);
}

echo PHP_EOL;
