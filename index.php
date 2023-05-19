<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
// $_SESSION['user'] = 'Md Anwar Hossain';
// session_destroy();
require('Helpers/functions.php');
require('Config/Response.php');
require('Router/Route.php');
require('Router/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

Route::router($uri, $method);



