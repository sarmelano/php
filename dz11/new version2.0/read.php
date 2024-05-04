<?php
require 'funcs.php';
$filePath = 'file.txt';

// Чтение из файла
$fileContents = readFileContents($filePath);
if ($fileContents === null) {
    echo "Файл логов не найден, пуст или не доступен для чтения.\n";
} else {
    echo "Последняя введенная строка: " . $fileContents . "\n";
}