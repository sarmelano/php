<?php

require_once 'BankAccount.php';

function terminalStart() {

    $account = new BankAccount("1234567890123456", 1000);

    echo "Номер счета: " . $account->getAccountNumber() . "\n";
    echo "Текущий баланс: " . $account->getBalance() . "\n";

    $handle = fopen("php://stdin", "r");
    echo "Выберите операцию:\n1. Пополнение счета\n2. Снятие со счета\n";
    $choice = trim(fgets($handle));

    try {
        switch ($choice) {
            case 1:
                echo "Введите сумму для пополнения: ";
                $amount = floatval(fgets($handle));
                $account->deposit($amount);
                break;
            case 2:
                echo "Введите сумму для снятия: ";
                $amount = floatval(fgets($handle));
                $account->withdraw($amount);
                break;
            default:
                echo "Неверный выбор операции.\n";
                break;
        }
        echo "Баланс: " . $account->getBalance() . "\n";
    } catch (Exception $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    } finally {
        echo "Мы ценим каждого клиента!\n";
    }

    fclose($handle);
}

terminalStart();