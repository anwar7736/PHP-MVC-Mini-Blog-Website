<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
}

function abort($code = 404)
{
    http_response_code($code); 
    require('Views/404.blade.php');
    die();
}

function isActive($uri)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $uri ? 'active' : '';
}