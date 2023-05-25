<?php

class Database{
    public $connection;
    public $statement;
    public function __construct($config, $user = "root", $pass = "")
    {
        $dsn = "mysql:".http_build_query($config, "", ";");
        $this->connection = new PDO($dsn, $user, $pass);
    }

    public function raw($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this->statement;
    }    
    
    public function query($query, $params = [])
    {
        $this->raw($query, $params);
        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }    
    
    public function find()
    {
        return $this->statement->fetch();
    }    
    
    public function findOrFail()
    {
        $result = $this->find();
        if(!$result)
        {
            abort(404);
        }

        return $result;
    }
    
}