<?php

require '../helper/bootstrap.php';

define('DEBUG', TRUE);

$router = new \Hankmvc\helper\Router();
$view = new \Hankmvc\view\View();
$dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$dbh = new PDO($dsn, DB_USER, DB_PASS);
$model = new \Hankmvc\model\Model($dbh);

$app = new \Hankmvc\helper\App($router, $view, $model);

// END
