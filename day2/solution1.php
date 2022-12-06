<?php

const ROCK = 1;
const PAPER = 2;
const SCISSORS = 3;

$plays = [
    'A' => ROCK,
    'B' => PAPER,
    'C' => SCISSORS,
    'X' => ROCK,
    'Y' => PAPER,
    'Z' => SCISSORS,
];

$score = 0;
$win = 0;
$lose = 0;
$draw = 0;
foreach (file(dirname(__FILE__) . '/input.txt') as $round) {
    list($theirs, $yours) = explode(' ', trim($round));

    if ($plays[$theirs] === $plays[$yours]) { // Draw
        $outcome = 3;
        $draw++;
    } else if (
        $plays[$theirs] === ROCK && $plays[$yours] === PAPER ||
        $plays[$theirs] === PAPER && $plays[$yours] === SCISSORS ||
        $plays[$theirs] === SCISSORS && $plays[$yours] === ROCK
    ) {
        $outcome = 6;
        $win++;
    } else {
        $outcome = 0;
        $lose++;
    }

    $score += $plays[$yours] + $outcome;
}

echo PHP_EOL;

echo 'Win = ' . $win . PHP_EOL;
echo 'Lose = ' . $lose . PHP_EOL;
echo 'Draw = ' . $draw . PHP_EOL;

echo PHP_EOL . 'Total Score ' . $score . PHP_EOL;
