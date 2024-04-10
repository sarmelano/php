<?php

// Запрос имени у пользователя
echo "Hello World! What's your name Creator?\n";
$userName = trim(fgets(STDIN));

// Запрос текущего года
echo "$userName, sir, welcome to my world. May I know what year is it now?\n";
$currentYear = trim(fgets(STDIN));

// Запрос года рождения пользователя
echo "What year you were born, $userName?\n";
$birthYear = trim(fgets(STDIN));

// Вычисление возраста пользователя
$userAge = $currentYear - $birthYear;

// Вывод возраста пользователя
echo "So you are just $userAge years old!\n";

// Установка возраста создателя
$creatorAge = 96;

// Вычисление года, когда создатель был на $creatorAge лет старше
$createYear = intval($birthYear) + $creatorAge;

// Вывод информации о годе создания
echo "You created me when you were $creatorAge years old. So it happened in $createYear\n";