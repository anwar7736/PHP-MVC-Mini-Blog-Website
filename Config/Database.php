<?php

class Database{
    public $connection;
    public function __construct($config, $user = "root", $pass = "")
    {
        $dsn = "mysql:".http_build_query($config, "", ";");
        $this->connection = new PDO($dsn, $user, $pass);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->query($query);
        $statement->execute($params);
        return $statement;
    }
    
}