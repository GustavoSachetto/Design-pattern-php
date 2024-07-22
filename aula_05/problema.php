<?php

/* ================ PROPOSTA ================ */

class Member
{
    private array $instances = [];

    public function getMembers(): array
    {
        return $this->instances['members'];
    }

    public function setMembers(string $name, int $age): void
    {
        $this->instances['members'][] = ['name' => $name, 'idade' => $age];
    }
}

$member1 = new Member;
$member1->setMembers('João Miguel', 15);
$member1->setMembers('Felipe Marcondez', 22);
$member1->setMembers('Letícia Silva', 17);

$member2 = new Member;
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