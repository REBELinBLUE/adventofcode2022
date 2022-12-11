<?php

$number_of_unique = 4;

$input = trim(file_get_contents(dirname(__FILE__) . '/input.txt'));

$received = [];

for ($position = 0; $position <= strlen($input); $position++) {
    $next = substr($input, $position, 1);

    if (count($received) == $number_of_unique) {
        unset($received[0]);
    }

    $received[] = $next;
    $received = array_values($received);

    if (count(array_unique($received)) == $number_of_unique) {
        echo "Solution - " . $position + 1 . PHP_EOL;
        break;
    }
}
