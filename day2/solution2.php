<?php

const ROCK = 1;
const PAPER = 2;
const SCISSORS = 3;

$plays = [
    'A' => ROCK,
    'B' => PAPER,
    'C' => SCISSORS,
];

$score = 0;
$win = 0;
$lose = 0;
$draw = 0;
foreach (file(dirname(__FILE__) . '/input.txt') as $round) {
    list($theirs, $result) = explode(' ', trim($round));

    if ($result === 'Z') { // Win
        if ($plays[$theirs] === ROCK) {
            $piece = PAPER;
        } else if ($plays[$theirs] === PAPER) {
            $piece = SCISSORS;
        } else if ($plays[$theirs] === SCISSORS) {
            $piece = ROCK;
        }

        $outcome = 6;
        $win++;

    } else if ($result === 'X') { // Lose
        if ($plays[$theirs] === ROCK) {
            $piece = SCISSORS;
        } else if ($plays[$theirs] === PAPER) {
            $piece = ROCK;
        } else if ($plays[$theirs] === SCISSORS) {
            $piece = PAPER;
        }

        $outcome = 0;
        $lose++;
    } else if ($result === 'Y') { // Draw
        $piece = $plays[$theirs];
        $outcome = 3;
        $draw++;
    }

    $score += $piece + $outcome;

}

echo PHP_EOL;

echo 'Win = ' . $win . PHP_EOL;
echo 'Lose = ' . $lose . PHP_EOL;
echo 'Draw = ' . $draw . PHP_EOL;

echo PHP_EOL . 'Total Score ' . $score . PHP_EOL;
