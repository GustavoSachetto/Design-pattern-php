<?php

/* ================ PROPOSTA ================ */

class MysqlPersistence
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

class MysqlCreator
{
    public function persist(array $data)
    {
        try {
            $database = new MysqlPersistence;

            $database->setData($data);
            $database->validate();
            $database->persist();
        } catch (\Exception $th) {
            echo 'Ocorreu um erro inesperado: '.$th->getMessage();
        }
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