<?php

use Config\Response;
use App\Models\Post;

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
    require base_path('resources/views/'.$url.'.blade.php');
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
        $image = $_FILES[$file]['name'];
        if($image)
        {
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            $name = rand().'.'.$extension;
            $upload_path = 'images/'.$folder.'/'.$name;
            if(move_uploaded_file($_FILES[$file]['tmp_name'], $upload_path))
            {
                return $name;
            }
        }

         return "";
}

function deleteFile($folder = null, $file = null)
{
    if(!empty($folder) && !empty($file))
    {
         $path = 'images/'.$folder.'/'.$file;
         if(file_exists($path))
         {
            unlink($path);
         }

         return true;
    }
   
}

function getFilePath($folder = null, $file = null)
{
    $path = "images/default/no_image.jpg";
    if(!empty($folder) && !empty($file))
    {
        $path = 'images/'.$folder.'/'.$file;
        if(file_exists($path))
        {
             return $path;
        }

        $path = 'images/default/no_image.jpg';
    }

    return $path;
   
}

function base_path($path)
{
    return BASE_PATH.$path;
}

function session($key, $value = '')
{
    if(!empty($value))
    {
        $_SESSION[$key] = $value;
    }    
    
    else
    {
       return $_SESSION[$key] ?? '';
    }
   
}

function destroy($key)
{
    if(isset($_SESSION[$key]))
    {
        unset($_SESSION[$key]);
    }    
   
}

function auth_post_count()
{
    $total_posts = Post::myPost();
    return count($total_posts);
}

function included($url, $data = [])
{
    extract($data);
    $url = str_replace('.', '/', $url);
    include base_path('resources/views/'.$url.'.blade.php');
}
