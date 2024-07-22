<?php

/* ================ STRATEGY ================ */

// ((( Strategy )))

/**
 * Aqui definimos todos os métodos que deveram ser implementados uma lógica. 
 */

interface BankService
{
    public function withdraw(float $amountOfMoney, float &$balance): float;
}

// ((( Concrete Strategy )))

/**
 * Aqui definimos classes que terão seus métodos concretos seguindo sua lógica específica.
 * Todas as classes deverão implementar a mesma estratégia.
 */

class Bradesco implements BankService
{
    public function withdraw(float $amountOfMoney, float &$balance): float
    {
        return $balance -= $amountOfMoney;
    }
}

class Nubank implements BankService
{
    private const MONEY_RATE = 13;

    public function withdraw(float $amountOfMoney, float &$balance): float
    {
        return $balance -= $amountOfMoney + self::MONEY_RATE;
    }
}

class Santander implements BankService
{
    private const PERCENTAGE_RATE = 5;

    public function withdraw(float $amountOfMoney, float &$balance): float
    {
        $rate = $this->getRate($amountOfMoney);

        return $balance -= $amountOfMoney += $rate;
    }

    private function getRate(float $amountOfMoney): float
    {
        return $amountOfMoney * (self::PERCENTAGE_RATE / 100);
    }
}

// ((( Context )))

/**
 * Aqui criamos um "controlador", uma classe que irá chamar a classe de interesse para 
 * se utilizar o método.
 */

class Bank
{
    private float $balance;

    public function __construct(float $newBalance) 
    {
        $this->balance = $newBalance;
    }

    public function deposit(float $amountOfMoney): void
    {
        $this->balance += $amountOfMoney;
    }

    /**
     * Método de saque do saldo.
     */
    public function withdraw(BankService $bank, float $amountOfMoney): string
    {
        return "Saldo restante na conta: ".$bank->withdraw($amountOfMoney, $this->balance);
    }

    public function getBalance(): string
    {
        return "Saldo na conta: ".$this->balance;
    }
}

$bank = new Bank(120);

echo "<pre>";
echo $bank->getBalance();
echo "</pre>";

echo "<pre>";
echo $bank->withdraw(new Santander, 40);
echo "</pre>";

echo "<pre>";
echo $bank->withdraw(new Bradesco, 40);
echo "</pre>";

echo "<pre>";
echo $bank->withdraw(new Nubank, 10);
echo "</pre>";

/* ========================================== */