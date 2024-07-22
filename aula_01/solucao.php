<?php

/* ================ BUILDER ================= */

// ((( Interface )))

/**
 * Aqui definimos todos os métodos que deveram ser implementados uma lógica. 
 */

interface SQLQueryBuilder
{
    public function select(string $table, array $fields): SQLQueryBuilder;
    public function where(string $field, string $value, string $operator = "="): SQLQueryBuilder;
    public function order(string $field, string $order): SQLQueryBuilder;
    public function limit(int $start, int $offset): SQLQueryBuilder;
    public function getSQL(): string;
}

// ((( Builder )))

/**
 * Aqui criamos uma classe que em seus métodos de criação retornará ela mesma. 
 * Assim, podendo construir diversos comandos diferentes etapa por etapa.
 */

class MysqlQueryBuilder implements SQLQueryBuilder
{
    protected stdClass $query;

    protected function reset(): void 
    {
        $this->query = new \stdClass();
    }

    public function select(string $table, array $fields): SQLQueryBuilder
    {
        $this->reset();
        $this->query->base = "SELECT ".implode(", ", $fields)." FROM {$table}";
        $this->query->type = "select";

        return $this;
    }

    public function where(string $field, string $value, string $operator = "="): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new Exception("WHERE pode apenas ser adicionado para SELECT, UPDATE ou DELETE"); 
        }
        $this->query->where[] = "{$field} {$operator} '{$value}'";

        return $this;
    }

    public function order(string $field, string $order): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) 
            throw new Exception("ORDER pode apenas ser adicionado para SELECT"); 
                
        $this->query->order = " ORDER BY {$field} {$order}";

        return $this;
    }

    public function limit(int $start, int $offset): SQLQueryBuilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT pode apenas ser adicionado para SELECT");
        }
        $this->query->limit = " LIMIT {$start} , {$offset}";

        return $this;
    }

    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $this->query->base;

        if (!empty($query->where)) 
            $sql .= " WHERE " . implode(' AND ', $query->where);

        if (isset($query->order)) 
            $sql .= $query->order;

        if (isset($query->limit)) 
            $sql .= $query->limit;

        return $sql .= ";";
    }
}

$queryBuilder = new MysqlQueryBuilder;

$query = $queryBuilder->select('user', ['id', 'name', 'email', 'password'])
           ->where('name', 'gustavo', 'LIKE')
           ->order('id', 'ASC')
           ->limit(10, 20)
           ->getSQL();

echo $query;

/* ========================================== */