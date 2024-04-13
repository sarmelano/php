<?php
declare(strict_types=1);
//кастом ф-я
function getInput(string $prompt): int {
    echo $prompt;//вывести алерт
    $input = trim(fgets(STDIN));//получить промпт

    while (!ctype_digit($input)) {// true в случае знаков 0-9
        echo "Ошибка: Вы должны ввести целое число.\n";
        echo $prompt;
        $input = trim(fgets(STDIN));
    }

    return intval($input);//интва устранит уязвимость, гарантир типизацию
}

// Вариант 1:
function powerNumber(int $number, int $power): float {
    return pow($number, $power);
}
// Вариант 2:
function powerNumberByReference(int &$number, int $power): void {
    $number = pow($number, $power);
}

$number = getInput('Введите любое целое число: ');
$power = getInput('Введите степень, в которую нужно возвести число: ');

// Вариант 1:
$newNumber = powerNumber($number, $power);
echo "Число $number в степени $power будет $newNumber\n";

// Вариант 2:
powerNumberByReference($number, $power);
echo "Перезаписанное число: $number\n";