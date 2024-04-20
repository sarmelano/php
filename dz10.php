<?php

function fibonacciGenerator(int $max): Generator {
    $current = 0;
    $next = 1;
    while ($current < $max) {
        yield $current;
        $newNext = $current + $next;
        $current = $next;
        $next = $newNext;
    }
}

echo "Введите максимальное число для последовательности Фибоначчи: ";
$input = trim(fgets(STDIN));
$max = (int)$input; //целое

foreach (fibonacciGenerator($max) as $v) {
    echo $v . PHP_EOL;
}