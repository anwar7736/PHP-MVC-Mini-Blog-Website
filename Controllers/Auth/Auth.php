<?php
// namespace Controllers\Auth;  

use Config\App;
use Config\Database;
use Config\Hash;

class Auth {
    public static $db;
    public function __construct()
    {
      static::$db = App::make('Config\Database');
    }

    public static function attempt($email, $pass)
    {
        $config = require base_path('Config/config.php');
        $db = new Database($config['database']);
        $user = $db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email
        ])->find();

        if($user && Hash::check($pass, $user['password']))
        {
            $_SESSION['user'] = $user;
            return true;
        }
        
        return false;

    }    
    
    public static function login($email, $pass)
    {
        static::attempt($email, $pass);
    }    
    
    public static function logout()
    {
        session_destroy();
    }    
    
    public static function user()
    {
        return isset($_SESSION['user']);
    }    
    
    public static function id()
    {
        return $_SESSION['user']['id'] ?? '';
    }    
    
    public static function name()
    {
        return $_SESSION['user']['name'] ?? '';
    }    
    
    public static function email()
    {
        return $_SESSION['user']['email'] ?? '';
    }    
    
    public static function password()
    {
        return $_SESSION['user']['password'] ?? '';
    }    
    
    public static function image()
    {
        return $_SESSION['user']['image'] ?? '';
    }
    
}