<?php

/* ============= FACTORY METHOD ============= */

// ((( Interface Product )))

/**
 * Aqui definimos todos os métodos que deveram ser implementados uma lógica. 
 */

interface DataPesistence
{
    public function setData(array $data): void;
    public function validate(): void;
    public function persist(): bool;
}

// ((( Concrete Product )))

/**
 * Criamos uma classe concreta, fornecendo as implementações da interface do produto.
 */

class MysqlPersistence implements DataPesistence
{
    public function setData(array $data): void
    {
        echo 'Recebe: '.json_encode($data);
    }
    
    public function validate(): void
    {
        echo 'Validando dados no DB';
    }

    public function persist(): bool
    {
        echo 'Comandos de INSERT ou UPDATE para salvar os dados';
        return true;
    }
}

// ((( Creator )))

/**
 * Definimos uma classe abstrata que irá declarar o método de fábrica, 
 * que retornará um objeto do produto concreto.
 */

abstract class PersistenceCreator
{
    abstract public function factoryMethod(): DataPesistence;

    public function persist(array $data)
    {
        try {
            $database = $this->factoryMethod();

            $database->setData($data);
            $database->validate();
            $database->persist();
        } catch (\Exception $th) {
            echo 'Ocorreu um erro inesperado: '.$th->getMessage();
        }
    }
}

// ((( Concrete Creator )))

/**
 * Criamos o criador concreto que irá mudar o método de fábrica retornando o objeto
 * do produto.
 */

class MysqlCreator extends PersistenceCreator
{
    public function factoryMethod(): DataPesistence
    {
        return new MysqlPersistence;
    }
}

$data = [
    'id'    => 1,
    'name'  => 'Gustavo Sachetto',
    'email' => 'gustavo.sachetto@gmail.com',
];

$creator = new MysqlCreator;
$creator->persist($data);

/* ========================================== */