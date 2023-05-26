<?php
use Router\Route;

//PostController
Route::get('/', 'PostController@index');
Route::get('/my-post', 'PostController@myPost')->middleware('auth');
Route::get('/post-create', 'PostController@create')->middleware('auth');
Route::post('/post-store', 'PostController@store')->middleware('auth');
Route::get('/post-show', 'PostController@show');
Route::get('/post-edit', 'PostController@edit')->middleware('auth');
Route::put('/post-update', 'PostController@update')->middleware('auth');
Route::delete('/post-destroy', 'PostController@destroy')->middleware('auth');

//Login, Logout, Register and Profile update
Route::get('/login', 'AuthController@loginView')->middleware('guest');
Route::post('/login', 'AuthController@login')->middleware('guest');
Route::post('/logout', 'AuthController@logout')->middleware('auth');
Route::get('/register', 'AuthController@registerView')->middleware('guest');
Route::post('/register', 'AuthController@register')->middleware('guest');
Route::get('/my-profile', 'AuthController@myProfile')->middleware('auth');
Route::put('/update-profile', 'AuthController@updateProfile')->middleware('auth');