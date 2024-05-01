<?php
$filename = "log.txt";
// Проверяем, существует ли файл и не пуст ли он
if (file_exists($filename) && filesize($filename) > 0) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES);// Читаем все строки из файла
    $lines = array_filter($lines, function($line) {
        return trim($line) !== ""; //если строка массива после trim не остается пустой "" то она остается в массиве. (Убираем пустые строки, пробелы, табуляции)
    });
    // Получаем последнюю строку
    if (!empty($lines)) {
        $lastLine = end($lines);
        echo "Последняя введенная строка: " . $lastLine . "\n";
    } else {
        echo "Файл логов пуст.\n";
    }
} else {
    echo "Файл логов не найден или пуст.\n";
}