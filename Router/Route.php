<?php

class Route {

    public $routes = [];

    public static function add($method, $uri, $controller)
    {
        $ob = new static;
        $ob->routes[] = compact('method', 'uri', 'controller');
    }        
    
    public static function get($uri, $controller)
    {
        $ob = new static;
        $ob->add('GET', $uri, $controller);
    }    
    
    public static function post($uri, $controller)
    {
        $ob = new static;
        $ob->add('POST', $uri, $controller);
    }    
    
    public static function put($uri, $controller)
    {
        $ob = new static;
        $ob->add('PUT', $uri, $controller);
    }    
    
    public static function patch($uri, $controller)
    {
        $ob = new static;
        $ob->add('PATCH', $uri, $controller);
    }    
    
    public static function delete($uri, $controller)
    {
        $ob = new static;
        $ob->add('DELETE', $uri, $controller);
    }

    public static function router()
    {
        $ob = new static;
    }
}