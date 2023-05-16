<?php
require('Route.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$routes = [

    '/' => 'PostController@index',
    '/post-create' => 'PostController@create',    
    '/post-store' => 'PostController@store',    
    '/post-show' => 'PostController@show',    
    '/post-edit' => 'PostController@edit',    
    '/post-update' => 'PostController@update',    
    '/post-destroy' => 'PostController@destroy',    
    // '/' => './Controllers/posts.php',    
    // '/post' => './Controllers/post.php',
];

function routeToController($uri, $routes)
{
    require('Config/Database.php');
    $config = require('Config/config.php');
    $db = new Database($config['database']);

    if(array_key_exists($uri, $routes))
    {
        $data = explode('@', $routes[$uri]);        

        require('./Controllers/'.$data[0].'.php');
        $object = new $data[0]($db);
        $method = $data[1];
        $object->$method();

        // require($routes[$uri]);
    }
    else {
        abort();
    }
}

routeToController($uri, $routes);