<?php
namespace App\Http\Controllers\Auth;  

use Config\App;
use Config\Hash;
use App\Models\User;

class Auth {
    public static $db;
    public function __construct()
    {
      static::$db = App::make('Config\Database');
    }

    public static function attempt($email, $pass)
    {
        $user = User::whereEmail($email)->first();

        if($user && Hash::check($pass, $user['password']))
        {
            session('user', $user);
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
        return session('user') ?? '';
    }    
    
    public static function id()
    {
        return session('user')['id'] ?? '';
    }    
    
    public static function name()
    {
        return session('user')['name'] ?? '';
    }    
    
    public static function email()
    {
        return session('user')['email'] ?? '';
    }    
    
    public static function password()
    {
        return session('user')['password'] ?? '';
    }    
    
    public static function image()
    {
        return session('user')['image'] ?? '';
    }
    
}