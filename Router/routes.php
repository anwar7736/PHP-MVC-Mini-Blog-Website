<?php
// $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
// $routes = [

//     '/' => 'PostController@index',
//     '/post-create' => 'PostController@create',    
//     '/post-store' => 'PostController@store',    
//     '/post-show' => 'PostController@show',    
//     '/post-edit' => 'PostController@edit',    
//     '/post-update' => 'PostController@update',    
//     '/post-destroy' => 'PostController@destroy',    
//     // '/' => './Controllers/posts.php',    
//     // '/post' => './Controllers/post.php',
// ];

// function routeToController($uri, $routes)
// {
//     require('Config/Database.php');
//     $config = require('Config/config.php');
//     $db = new Database($config['database']);

//     if(array_key_exists($uri, $routes))
//     {
//         $data = explode('@', $routes[$uri]);        

//         require('./Controllers/'.$data[0].'.php');
//         $object = new $data[0]($db);
//         $method = $data[1];
//         $object->$method();

//         // require($routes[$uri]);
//     }
//     else {
//         abort();
//     }
// }

// routeToController($uri, $routes);

//     '/' => 'PostController@index',
//     '/post-create' => 'PostController@create',    
//     '/post-store' => 'PostController@store',    
//     '/post-show' => 'PostController@show',    
//     '/post-edit' => 'PostController@edit',    
//     '/post-update' => 'PostController@update',    
//     '/post-destroy' => 'PostController@destroy',   


//Post
Route::get('/', 'PostController@index');
Route::get('/post-create', 'PostController@create')->middleware('auth');
Route::post('/post-store', 'PostController@store')->middleware('auth');
Route::get('/post-show', 'PostController@show');
Route::get('/post-edit', 'PostController@edit')->middleware('auth');
Route::put('/post-update', 'PostController@update')->middleware('auth');
Route::delete('/post-destroy', 'PostController@destroy')->middleware('auth');

//Login, Logout and Register
Route::get('/login', 'AuthController@loginView')->middleware('guest');
Route::post('/login', 'AuthController@login')->middleware('guest');
Route::post('/logout', 'AuthController@logout')->middleware('auth');
Route::get('/register', 'AuthController@registerView')->middleware('guest');
Route::post('/register', 'AuthController@register')->middleware('guest');