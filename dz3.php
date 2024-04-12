<?php

// Целые числа
$num1 = 10;
$num2 = "10";

echo "Сравнение целых чисел:\n";
echo "num1 == num2: " . ($num1 == $num2 ? "true" : "false") . "\n"; // Нестрогое равенство
echo "num1 === num2: " . ($num1 === $num2 ? "true" : "false") . "\n"; // Строгое равенство
echo "\n";

// Строки
$str1 = "hello";
$str2 = "Hello";

echo "Сравнение строк:\n";
echo "str1 == str2: " . ($str1 == $str2 ? "true" : "false") . "\n"; // Нестрогое равенство
echo "str1 === str2: " . ($str1 === $str2 ? "true" : "false") . "\n"; // Строгое равенство
echo "\n";

// Логические значения
$bool1 = true;
$bool2 = 1;

echo "Сравнение логических значений:\n";
echo "bool1 == bool2: " . ($bool1 == $bool2 ? "true" : "false") . "\n"; // Нестрогое равенство
echo "bool1 === bool2: " . ($bool1 === $bool2 ? "true" : "false") . "\n"; // Строгое равенство
echo "\n";

// Массивы
$arr1 = [1, 2, 3];
$arr2 = [1, 2, '3'];

echo "Сравнение массивов:\n";
echo "arr1 == arr2: " . ($arr1 == $arr2 ? "true" : "false") . "\n"; // Нестрогое равенство
echo "arr1 === arr2: " . ($arr1 === $arr2 ? "true" : "false") . "\n"; // Строгое равенство
echo "\n";

// NULL и пустые значения
$val1 = null;
$val2 = '';

echo "Сравнение NULL и пустых значений:\n";
echo "val1 == val2: " . ($val1 == $val2 ? "true" : "false") . "\n"; // Нестрогое равенство
echo "val1 === val2: " . ($val1 === $val2 ? "true" : "false") . "\n"; // Строгое равенство
