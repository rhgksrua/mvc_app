<?php

require '../helper/bootstrap.php';

define('DEBUG', TRUE);

$router = new Router;
$view = new View;
$dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
$dbh = new PDO($dsn, DB_USER, DB_PASS);
$model = new Model($dbh);

//$app = new App(new Router(), new View());
$app = new App($router, $view, $model);

// END
