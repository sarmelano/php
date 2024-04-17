<?php
declare(strict_types=1);

function crazyFunc(int $arg1, int $arg2, ?Closure $callback = null): int {
    $multiply = $arg1 * $arg2;

    if ($callback !== null) {
        $callback($multiply);
    }

    return (int) $multiply;
};

$printResult = function (int $result): void { //(анон) => принт
    echo "Результат: $result\n";
};

crazyFunc(5, 3, $printResult);