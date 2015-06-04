<?php

require '../view/View.php';

class Controller {


    // PDO instance
    public $dbh = null;

    // model for controller
    public $model = null;
    protected $view = null;

    public function __construct() {
        $this->view = new View();



    }

    //  Connect to DB using defined var in config.php
    public function connectToDB() {
        $dsn = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        zzz('$dsn', $dsn);
        $this->dbh = new PDO($dsn, DB_USER, DB_PASS);

    }

    // Create Model instance in this->model
    public function loadModel($mdl) {
        require "../model/Model.php";
        require "../model/{$mdl}.php";
        $this->model = new $mdl($this->dbh);

    }


}
