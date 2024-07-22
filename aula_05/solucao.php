<?php

/* =============== SINGLETON ================ */

// ((( Singleton )))

/**
 * Criamos uma classe concreta, fornecendo as implementações da interface do comando.
 */

class Member
{
    private static array $instances = [];

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup () 
    {
        throw new Exception("Não pode serializar um singleton");
    }

    public static function getInstance(): Member
    {
        $cls = static::class;

        if (!isset(self::$instances[$cls])) 
            self::$instances[$cls] = new static();

        return self::$instances[$cls];
    }

    public function getMembers(): array
    {
        return self::$instances['members'];
    }

    public function setMembers(string $name, int $age): void
    {
        self::$instances['members'][] = ['name' => $name, 'idade' => $age];
    }
}

$member1 = Member::getInstance();
$member1->setMembers('João Miguel', 15);
$member1->setMembers('Felipe Marcondez', 22);
$member1->setMembers('Letícia Silva', 17);

$member2 = Member::getInstance();
$member2->setMembers('José Luiz', 22);
$member2->setMembers('Gustavo Sachetto', 18);
$member2->setMembers('Taiz Yury', 19);

echo "<pre>";
var_dump($member1->getMembers());
echo "</pre>";

echo "<pre>";
var_dump($member2->getMembers());
echo "</pre>";

/* ========================================== */