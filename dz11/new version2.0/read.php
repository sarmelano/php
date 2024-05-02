<?php
require 'funcs.php';
$filePath = 'file.txt';

// Чтение из файла
$fileContents = readFileContents($filePath);
echo $fileContents;