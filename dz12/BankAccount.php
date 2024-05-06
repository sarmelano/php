<?php

class BankAccount {
    private string $accountNumber;
    private float $balance;

    /**
     * @throws Exception
     */
    public function __construct(string $accountNumber, float $initialBalance = 0) {
        $this->setAccountNumber($accountNumber);
        $this->setBalance($initialBalance);
    }

    /**
     * @throws Exception
     */
    private function setAccountNumber(string $accountNumber): void {
        if (!ctype_digit($accountNumber) || strlen($accountNumber) != 16) {
            throw new Exception("Номер счета должен быть числом и содержать ровно 16 цифр.");
        }
        $this->accountNumber = $accountNumber;
    }

    /**
     * @throws Exception
     */
    private function setBalance(float $balance): void {
        if ($balance < 0) {
            throw new Exception("Баланс не может быть отрицательным.");
        }
        $this->balance = $balance;
    }

    public function getAccountNumber(): string {
        return $this->accountNumber;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    /**
     * @throws Exception
     */
    private function updateBalance(float $amount, bool $isDeposit): void {
        if ($amount <= 0) {
            throw new Exception("Сумма операции должна быть больше нуля.");
        }
        if (!$isDeposit && $this->balance < $amount) {
            throw new Exception("Недостаточно средств на счёте.");
        }
        $newBalance = $isDeposit ? $this->balance + $amount : $this->balance - $amount;
        $this->setBalance($newBalance);
    }

    /**
     * @throws Exception
     */
    public function deposit(float $amount): void {
        $this->updateBalance($amount, true);
    }

    /**
     * @throws Exception
     */
    public function withdraw(float $amount): void {
        $this->updateBalance($amount, false);
    }
}
/*
 Конструктор — это специальный метод, который автоматически вызывается при создании нового объекта класса.
 В нашем случае конструктор принимает три параметра: имя, электронную почту и возраст пользователя.
 Он использует эти данные для инициализации свойств объекта с помощью методов setName, setEmail и setAge.

 Методы setName, setEmail, setAge используются для установки значений свойств объекта.
 Они позволяют контролировать, какие данные могут быть присвоены свойствам, например,
 проверяя длину имени перед его установкой.

 Методы getName, getEmail, getAge используются для получения значений свойств объекта (return).
 Они обеспечивают безопасный доступ к данным объекта, скрывая детали реализации
 и предоставляя только необходимую информацию.
*/