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

function uploadFile($folder = null, $file = null)
{
    
}

function deleteFile($folder = null, $file = null)
{
    if(!empty($folder) && !empty($file))
    {
         $path = 'public/images/'.$folder.'/'.$file;
         if(file_exists($path))
         {
            unlink($path);
         }

         return true;
    }
   
}

function getFilePath($folder = null, $file = null)
{
    if(!empty($folder) && !empty($file))
    {
        $path = 'public/images/'.$folder.'/'.$file;
        if(file_exists($path))
        {
            return $path;
        }

        return 'public/images/default/no_image.jpg';
    }
   
}