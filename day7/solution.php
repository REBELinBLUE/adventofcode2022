<?php

function traverse_filesystem(): array
{
    $directories = [];

    $cwd = [];

    foreach (file(dirname(__FILE__) . '/input.txt') as $command) {
        $command = trim($command);

        if ($command === '$ ls') {
            // Don't care about the list commands
            continue;
        }

        if (str_contains($command, '$ cd')) {
            $dir = str_replace('$ cd ', '', $command);

            if ($dir === '..') {
                array_pop($cwd);
            } else {
                array_push($cwd, $dir);
            }
        }

        $current_directory = str_replace('//', '/', implode('/', $cwd));

        if (!array_key_exists($current_directory, $directories)) {
            $directories[$current_directory] = [
                'files' => [],
                'size' => 0,
                'subdirs' => []
            ];
        }

        if (str_contains($command, 'dir')) {
            $dir = str_replace('dir ', '', $command);

            $directories[$current_directory]['subdirs'][] = $dir;
        }

        if (preg_match('/^(?P<size>\d*) (?P<file>.*)$/', $command, $matches)) {
            $directories[$current_directory]['files'][$matches['file']] = $matches['size'];
            $directories[$current_directory]['size'] = $directories[$current_directory]['size'] + (int) $matches['size'];
        }
    }

    ksort($directories, SORT_NATURAL);

    // There has to be a better way to do this, in the above loop?
    foreach (array_reverse($directories) as $path => $contents) {
        $parts = explode('/', $path);

        $cwd = [];

        foreach ($parts as $part) {
            array_push($cwd, $part);

            $current_directory = str_replace('//', '/', ('/' . implode('/', $cwd)));

            if ($path === $current_directory) {
                continue;
            }

            if (array_key_exists($current_directory, $directories)) {
                $directories[$current_directory]['size'] += $contents['size'];
            }
        }
    }

    return $directories;
}

$directories = traverse_filesystem();

$small = array_filter($directories, fn(array $value) => $value['size'] > 0 && $value['size'] <= 100000);

echo 'Solution 1' . PHP_EOL;
echo array_sum(array_column($small, 'size')) . PHP_EOL;

echo 'Solution 2' . PHP_EOL;
$required = 30000000;
$total = 70000000;
$used = $directories['/']['size'];

$remaining = $total - $used;

$needed = $required - $remaining;

$candelete = array_filter($directories, fn(array $value) => $value['size'] >= $needed);

uasort($candelete, fn(array $a, array $b) => $a['size'] <=> $b['size']);
$smallest = reset($candelete);

echo $smallest['size'] . PHP_EOL;
