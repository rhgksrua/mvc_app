<?php

require "../config/config.php";
require '../config/bootstrap.php';

/**
 * Some constants for directories
 *
 */
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'App' . DIRECTORY_SEPARATOR);
define('TEMPLATE', APP . 'View/templates' . DIRECTORY_SEPARATOR);
define('CONTROLLER', APP . 'Controller' . DIRECTORY_SEPARATOR);

/** 
 * composer autoload
 *
 * autoloads if file found
 */
if (file_exists(ROOT . 'vendor/autoload.php')) {
    require ROOT . 'vendor/autoload.php';
}

$router = new \Hankmvc\App\Core\Router();
$view = new \Hankmvc\App\View\View();

// DB init
$dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$dbh = new PDO($dsn, DB_USER, DB_PASS);
$model = new \Hankmvc\App\Model\Model($dbh);

$app = new \Hankmvc\App\Core\App($router, $view, $model);

// EOF
