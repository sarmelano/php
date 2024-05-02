<?php

function readFileContents($filename): string {
    if (!file_exists($filename) || !is_readable($filename) || filesize($filename) <= 0) {
        return "Файл логов не найден, пуст или не доступен для чтения.\n";
    }
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    $lines = array_filter($lines, function ($line) {
        return trim($line) !== "";
    });
    if (empty($lines)) {
        echo "Файл логов пуст.\n";
    }
    $lastLine = end($lines);
    return "Последняя введенная строка: " . $lastLine . "\n";
}

function writeFileContents($filePath, $data, $append = false): string {
    $flags = $append ? FILE_APPEND : 0;
    $result = file_put_contents($filePath, $data, $flags);
    if ($result === false) {
        return "Не удалось записать данные в файл\n";
    } else {
        return "Введенные данные записаны в файл $filePath\n";
    }
}