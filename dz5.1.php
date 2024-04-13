<?php
declare(strict_types=1);

function getInput(string $prompt): float {
    echo $prompt;
    $input = trim(fgets(STDIN));

    while (!is_numeric($input)) {
        echo "Ошибка: Вы должны ввести число.\n";
        echo $prompt;
        $input = trim(fgets(STDIN));
    }

    return (float)$input;
}

function calcCircleArea(int|float $radius): float {
    return M_PI * $radius ** 2;
}
//-------------------------------------------------------------------------------
$radius = getInput('Введите радиус круга в сантиметрах: ');//alert + prompt + check
$circleArea = calcCircleArea($radius);//calculate
echo "Площадь круга с радиусом $radius см: " . number_format($circleArea, 2) . " квадратных см\n";