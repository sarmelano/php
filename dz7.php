<?php
//Виведіть на екран всі числа від 1 до 10 використовуючи цикл while
echo '------------------Task 1-----------------' . PHP_EOL;
$i = 1;
while ($i <= 10) {
    echo $i . PHP_EOL;
    $i++;
}

//Обчисліть факторіал числа 5 використовуючи цикл while.
echo '------------------Task 2-----------------' . PHP_EOL;
$i = 1;
$factorial = 1;
while ($i <= 5) {
    $factorial *= $i;
    $i++;
}
echo 'factorial 5 = ' . $factorial . PHP_EOL;

//Виведіть на екран всі парні числа від 1 до 20 використовуючи цикл while.
echo '------------------Task 3-----------------' . PHP_EOL;
$i = 1;
while ($i <= 20) {
    if($i % 2 === 0) {
        echo $i . PHP_EOL;
    }
    $i++;
}