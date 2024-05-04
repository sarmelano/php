<?php
require 'funcs.php';
$filePath = 'file.txt';

echo "Введите данные: ";
$input = fgets(STDIN);
$writeResult = writeFileContents($filePath, $input, true); // true для дописывания в конец файла
if ($writeResult) {
    echo "Введенные данные записаны в файл $filePath\n";
} else {
    echo "Не удалось записать данные в файл\n";
}