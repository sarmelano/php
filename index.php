<?php

setcookie('test', 'test value', time() + 3600);
session_start();

define('APP_DIR', __DIR__ . '/');
define('CONTROLLERS_DIR', APP_DIR . 'controllers/');
define('VIEWS_DIR', APP_DIR . 'views/');
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'mysql');
define('DB_PORT', '3306');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'hillel');

$requiredFiles = [
    'system/Request.php',
    'system/Router.php',
    'system/View.php',
    'system/Functions.php',
    'system/Validator.php',
    'system/Session.php',
    'system/Response.php',
    'system/Config.php',
    'database/Connect.php',
    'system/Auth.php'
];

foreach ($requiredFiles as $file) {
    require_once APP_DIR . $file;
}


$router = new Router();

$router->addRoute('/', [  //breadcrumbs
    'get' => 'HomeController@index',
]);

$router->addRoute('/register', [  //breadcrumbs
    'get' => 'AuthController@register',
    'post' => 'AuthController@registerProcess',
]);

$router->addRoute('/login', [   //breadcrumbs
    'get' => 'AuthController@login',
    'post' => 'AuthController@auth',
]);

$router->addRoute('/signOut', [   //breadcrumbs
    'get' => 'AuthController@signOut',
]);

$router->processRoute(Request::getUrl(), Request::getMethod());