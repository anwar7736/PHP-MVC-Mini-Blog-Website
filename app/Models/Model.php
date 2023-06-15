<?php
namespace App\Models;
use Config\App;
use Config\Database;

abstract class Model {
    public function __construct()
    {
        App::bind('Config\Database', function(){
            $config = require base_path('Config/config.php');
            return new Database($config['database']);
        });
        
        return App::make('Config\Database');
        
    }
	
}
