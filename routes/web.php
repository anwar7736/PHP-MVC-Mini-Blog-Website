<?php
use Routes\Route;


//PostController
Route::get('/', 'App\Http\Controllers\PostController@index');
Route::get('/my-post', 'App\Http\Controllers\PostController@myPost')->middleware('auth');
Route::get('/post-create', 'App\Http\Controllers\PostController@create')->middleware('auth');
Route::post('/post-store', 'App\Http\Controllers\PostController@store')->middleware('auth');
Route::get('/post-show', 'App\Http\Controllers\PostController@show');
Route::get('/post-edit', 'App\Http\Controllers\PostController@edit')->middleware('auth');
Route::put('/post-update', 'App\Http\Controllers\PostController@update')->middleware('auth');
Route::delete('/post-destroy', 'App\Http\Controllers\PostController@destroy')->middleware('auth');


//Login, Logout, Register and Profile update
Route::get('/login', 'App\Http\Controllers\AuthController@loginView')->middleware('guest');
Route::post('/login', 'App\Http\Controllers\AuthController@login')->middleware('guest');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth');
Route::get('/register', 'App\Http\Controllers\AuthController@registerView')->middleware('guest');
Route::post('/register', 'App\Http\Controllers\AuthController@register')->middleware('guest');
Route::get('/my-profile', 'App\Http\Controllers\AuthController@myProfile')->middleware('auth');
Route::put('/update-profile', 'App\Http\Controllers\AuthController@updateProfile')->middleware('auth');