<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
}

function abort($code = RESPONSE::NOT_FOUND)
{
    http_response_code($code); 
    return view($code, compact('code'));
    die();
}

function isActive($uri)
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] == $uri ? 'active' : '';
}

function view($url, $data = [])
{
    extract($data);
    $url = str_replace('.', '/', $url);
    require('Views/'.$url.'.blade.php');
}

function redirect($url)
{
    header("location: {$url}");
}

function old($name)
{
    return $_POST[$name] ?? '';
}

function uploadFile($folder, $file)
{
    
}

function deleteFile($folder, $file)
{
    
}