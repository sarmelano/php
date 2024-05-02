<?php
require 'funcs.php';
$filePath = 'file.txt';

echo "Введите данные: ";
$input = fgets(STDIN);
$writeResult = writeFileContents($filePath, $input, true); // true для дописывания в конец файла
echo $writeResult;