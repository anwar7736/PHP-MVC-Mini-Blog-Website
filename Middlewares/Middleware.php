<?php
require base_path('Middlewares/AuthMiddleware.php');
require base_path('Middlewares/GuestMiddleware.php');
class Middleware {
    public const MAP = [
        'auth' => AuthMiddleware::class,
        'guest' => GuestMiddleware::class
    ]; 
    
    public static function resolve($key)
    {
       if(!$key)
       {
            return;
       }

       $middleware = static::MAP[$key];
       if(!$middleware)
       {
            throw new \Exception('No middleware was found for this key : '.$key);
       }

       (new $middleware)->handle();

    }
}