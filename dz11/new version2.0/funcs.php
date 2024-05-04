<?php

function readFileContents(string $filename): ?string {//стр или null
    if (!file_exists($filename) || !is_readable($filename) || filesize($filename) <= 0) {
        return null; // не существует, нечитаем или пуст
    }
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    $lines = array_filter($lines, function ($line) {
        return trim($line) !== "";
    });
    if (empty($lines)) {
        return null; //файл пуст после фильтрации
    }
    return end($lines);
}

function writeFileContents(string $filePath, string  $data, bool $append = false): bool {
    $flags = $append ? FILE_APPEND : 0;
    $result = file_put_contents($filePath, $data, $flags);
    return $result !== false; // в зависимости от успеха операции
}