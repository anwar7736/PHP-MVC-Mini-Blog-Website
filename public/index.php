<?php

use Routes\Route;

session_start();

date_default_timezone_set("Asia/Dhaka");

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'app/helpers/helpers.php';

require base_path('routes/web.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

Route::router($uri, $method);    











