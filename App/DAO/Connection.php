<?php

namespace App\DAO;

abstract class Connection{

    /**
     * @var \PDO
     */

    protected $pdo;

    public function __construct(){
        $host = getenv('PROJETO_SERDUC_MYSQL_HOST');
        $port = getenv('PROJETO_SERDUC_MYSQL_PORT');
        $user = getenv('PROJETO_SERDUC_MYSQL_USER');
        $pass = getenv('PROJETO_SERDUC_MYSQL_PASSWORD');
        $dbname = getenv('PROJETO_SERDUC_MYSQL_DBNAME');

        $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(
            \PDO::ATTR_ERRMODE,
            \PDO::ERRMODE_EXCEPTION
        );

    }
}