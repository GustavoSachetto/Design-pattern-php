<?php

/* ================ PROPOSTA ================ */

class Car
{
    public static function check(string $request): ?string
    {
        if ($request == "carro")
            return "Seu veículo é um carro!";
        else
            return Motorcycle::check($request);
    }
}

class Motorcycle
{
    public static function check(string $request): ?string
    {
        if ($request == "moto")
            return "Seu veículo é uma moto!";
        else
            return Bike::check($request);
    }
}

class Bike
{
    public static function check(string $request): ?string
    {
        if ($request == "bicicleta")
            return "Seu veículo é uma bicicleta!";
        else
            return null;
    }
}

$car = new Car;

echo "<pre>";
var_dump($car->check("moto"));
echo "</pre>";

echo "<pre>";
var_dump($car->check("bicicleta"));
echo "</pre>";

echo "<pre>";
var_dump($car->check("aviao"));
echo "</pre>";

/* ========================================== */