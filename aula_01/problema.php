<?php

/* ================ PROPOSTA ================ */

class MysqlQueryBuilder
{
    public function select(
        string $table, 
        string $where = null, 
        string $order = null, 
        string $limit = null, 
        string $fields = '*'
        ): string
    {
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        $query = 'SELECT '.$fields.' FROM '.$table.' '.$where.' '.$order.' '.$limit. ';';

        return $query;
    }
}

$queryBuilder = new MysqlQueryBuilder;

$query = $queryBuilder->select('user', "name LIKE 'gustavo'", 'id ASC', '10 , 20', 'id, name, email, password');

echo $query;

/* ========================================== */