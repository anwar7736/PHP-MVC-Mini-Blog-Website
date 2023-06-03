<?php
session_start();
date_default_timezone_set("Asia/Dhaka");

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'Helpers/functions.php';

// require base_path('Config/Response.php');
// require base_path('Config/Database.php');
// require base_path('Config/App.php');
// require base_path('Router/Route.php');
require base_path('Router/routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

use Router\Route;

Route::router($uri, $method);    









