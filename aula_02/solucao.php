<?php

/* ============== CHAIN OF R. =============== */

// ((( Interface )))

/**
 * Aqui definimos todos os métodos que deveram ser implementados uma lógica. 
 */

interface Handler
{
    public function setNext(Handler $handler): Handler;
    public function handle(string $request): ?string;
}

// ((( Handdler )))

/**
 * Definimos uma classe abstrata para gerenciar o próximo manipulador a ser chamado.
 */

abstract class AbstractHanddler implements Handler
{
    private Handler $nextHandler;

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    public function handle(string $request): ?string
    {
        if (isset($this->nextHandler)) 
            return $this->nextHandler->handle($request);
        
        return null;
    }
}


// ((( Concrete Handdler )))

/**
 * Implementamos o manipulador concreto, sobreescrevendo o método handle. 
 * Assim conseguimos criar uma chamada de métodos em cadeia.
 */

class Car extends AbstractHanddler
{
    public function handle(string $request): ?string
    {
        if ($request == "carro")
            return "Seu veículo é um carro!";
        else
            return parent::handle($request);
    }
}

class Motorcycle extends AbstractHanddler
{
    public function handle(string $request): ?string
    {
        if ($request == "moto")
            return "Seu veículo é uma moto!";
        else
            return parent::handle($request);
    }
}

class Bike extends AbstractHanddler
{
    public function handle(string $request): ?string
    {
        if ($request == "bicicleta")
            return "Seu veículo é uma bicicleta!";
        else
            return parent::handle($request);
    }
}

$car = new Car;
$motorcycle = new Motorcycle;
$bike = new Bike;

$car->setNext($motorcycle)->setNext($bike);

echo "<pre>";
var_dump($car->handle("moto"));
echo "</pre>";

echo "<pre>";
var_dump($car->handle("bicicleta"));
echo "</pre>";

echo "<pre>";
var_dump($car->handle("aviao"));
echo "</pre>";


/* ========================================== */