<?php
declare(strict_types=1);
$sum = 0;
$mul = 1;
$res = [];

//Створити пустий масив і заповнити його випадковими значеннями. (створити функцію як на уроці).
echo '------------------Task 1-----------------' . PHP_EOL;
function genArray (int $l = 10, int $min = 1, int $max = 10): array {
    $randomArray = [];
    for ($i = 0; $i < $l; $i++) {
        $randomArray[] = mt_rand($min, $max);
    }

    return $randomArray;
}

$arr1 = genArray();

echo 'Random array: ' . implode(', ', $arr1);
echo PHP_EOL;


//Порахувати суму елементів масиву.
echo '------------------Task 2-----------------' . PHP_EOL;
foreach ($arr1 as $value) {
    $sum += $value;
}
echo 'Сумма всех элементов массива = ' . $sum . PHP_EOL;


//Порахувати добуток всіх елементів масиву.
echo '------------------Task 3-----------------' . PHP_EOL;
foreach ($arr1 as $value) {
    $mul *= $value;
}
echo 'Добуток всех элементов массива = ' . $mul . PHP_EOL;


//Перевірте скільки раз число 5 зустрічається у вас в масиві.
echo '------------------Task 4-----------------' . PHP_EOL;
$count = 0;
foreach ($arr1 as $value) {
    if ($value === 5) {
        $count++;
    }
}
echo 'Число 5 встретилось в Random array ' . $count . ' раз' . PHP_EOL;

//Виведіть на екран тільки числа, які націло діляться на 3.
echo '------------------Task 5-----------------' . PHP_EOL;
foreach ($arr1 as $value) {
    if($value % 3 === 0) {
        $res[] = $value;
    }
}

echo 'В Random array деляться на 3 без остатка: ' . implode(', ', $res);
echo PHP_EOL;