<?php

echo "Введите данные: ";
$input = fgets(STDIN);

// Запись с проверкой на ошибку
$result = file_put_contents("log.txt", $input, FILE_APPEND);

if ($result === false) {
    echo "Не удалось записать данные в файл.\n";
} else {
    echo "Введенные данные записаны в файл log.txt.\n";
}