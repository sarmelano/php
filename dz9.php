<?php
//==========================<Функции>==========================
function generateAr(int $length, int $min, int $max): array {
    $array = [];
    for ($i = 0; $i < $length; $i++) {
        $array[] = mt_rand($min, $max);
    }
    return $array;
}

function getInput(string $prompt): int {
    echo $prompt;
    $input = trim(fgets(STDIN));
    while (!ctype_digit($input) || $input === "0") {
        if ($input === "0") {
            echo "Ошибка: Ввод нуля не допустим. С Вас 100 баллов за дз\n";
            echo $prompt;
        } elseif (!ctype_digit($input)) {
            echo "Ошибка: Вы должны ввести целое число.\n";
            echo $prompt;
        }
        $input = trim(fgets(STDIN));
    }
    return intval($input);
}

function analyzeArray(array $arr): array {
    $sortedArr = $arr;
    sort($sortedArr);
    return [
        'max' => max($arr),
        'min' => min($arr),
        'sorted' => $sortedArr
    ];
}
//==========================<Запросы>==========================
$length = getInput("Введите длину массива: ");
$min = getInput("Введите минимальное значение: ");
$max = getInput("Введите максимальное значение: ");

$arr1 = generateAr($length, $min, $max);
echo "Изначальный массив: " . implode(', ', $arr1) . PHP_EOL;
//==========================<Результаты>==========================
$results = analyzeArray($arr1);
echo "Самое большое число из массива: " . $results['max'] . PHP_EOL;
echo "Самое малое число из массива: " . $results['min'] . PHP_EOL;
echo "Отсортированный массив: " . implode(', ', $results['sorted']) . PHP_EOL;
?>