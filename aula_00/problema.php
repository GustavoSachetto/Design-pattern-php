<?php

/* ================ PROPOSTA ================ */

class Bradesco 
{
    public function withdraw(float $amountOfMoney, &$createBalanceTotal = 0): float
    {
        return $createBalanceTotal -= $amountOfMoney;
    }
}

class Nubank
{
    private const MONEY_RATE = 13;
    
    public function withdrawValue(float $quantityMoney, &$balanceTotal): float
    {
        return $balanceTotal -= $quantityMoney + self::MONEY_RATE;
    }
}

class Santander
{
    private const PERCENTAGE_RATE = 5;

    public function withdrawAmountOfMoney(float $price, float &$balance): float
    {
        $rate = $this->getRate($price);

        return $balance -= $price += $rate;
    }

    private function getRate(float $price): float
    {
        return $price * (self::PERCENTAGE_RATE / 100);
    }
}

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
    public function withdraw(string $bank, float $amountOfMoney): string
    {
        if ($bank == "Santander") {

            $santander = new Santander;

            $result = $santander->withdrawAmountOfMoney($amountOfMoney, $this->balance);

        } elseif ($bank == "Nubank") {

            $nubank = new Nubank;

            $result = $nubank->withdrawValue($amountOfMoney, $this->balance);
            
        } else if ($bank == "Bradesco") {
            
            $bradesco = new Bradesco($this->balance);

            $result = $bradesco->withdraw($amountOfMoney, $this->balance);

        }

        return "Saldo restante na conta: ".$result;
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
echo $bank->withdraw("Santander", 40);
echo "</pre>";

echo "<pre>";
echo $bank->withdraw("Bradesco", 40);
echo "</pre>";

echo "<pre>";
echo $bank->withdraw("Nubank", 10);
echo "</pre>";

/* ========================================== */