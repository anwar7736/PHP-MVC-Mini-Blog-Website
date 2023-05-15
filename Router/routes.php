<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => './Controllers/posts.php',
    '/post' => './Controllers/post.php',

];

function routeToController($uri, $routes)
{
    if(array_key_exists($uri, $routes))
    {
        require($routes[$uri]);
    }
    else {
        abort();
    }
}

routeToController($uri, $routes);