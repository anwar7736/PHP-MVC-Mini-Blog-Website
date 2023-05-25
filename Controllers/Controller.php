<?php
// namespace Controllers;

abstract class Controller {
    public $db;
    public function __construct()
    {
        $config = require base_path('Config/config.php');
        return new Database($config['database']);
        
    }
}