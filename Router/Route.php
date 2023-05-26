<?php
namespace Router;
use Middlewares\Middleware;

require base_path('Middlewares/Middleware.php');
require base_path('Controllers/Auth/Auth.php');

class Route {

    public static $routes = [];

    public static function add($method, $uri, $controller)
    {
        static::$routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => '',
        ];

        return new self;
    }        
    
    public static function get($uri, $controller)
    {
        return static::add('GET', $uri, $controller);
    }    
    
    public static function post($uri, $controller)
    {
        return static::add('POST', $uri, $controller);
    }    
    
    public static function put($uri, $controller)
    {
        return static::add('PUT', $uri, $controller);
    }    
    
    public static function patch($uri, $controller)
    {
        return static::add('PATCH', $uri, $controller);
    }    
    
    public static function delete($uri, $controller)
    {
        return static::add('DELETE', $uri, $controller);
    }
    
    public static function middleware($key)
    {
        static::$routes[array_key_last(static::$routes)]['middleware'] = $key;
    }

    public static function router($uri, $method)
    {
        $status = 0;
        foreach(static::$routes as $route)
        {
            if($route['uri'] == $uri && $route['method'] == strtoupper($method))
            {
                Middleware::resolve($route['middleware']);
                $data = explode('@', $route['controller']);        
                require base_path('./Controllers/'.$data[0].'.php');
                $object = new $data[0];
                $method = $data[1];
                $object->$method();
                $status = 1;
            }
            
        }

        if($status == 0)
        {
            abort();
        }
    }
}