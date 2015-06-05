<?php

require '../view/View.php';

class Controller {

    // PDO instance
    public $dbh = null;

    // model for controller
    public $model = null;
    public $view = null;

    /**
     * Base controller
     * 
     * @param View used for rendering.
     */
    public function __construct() {

    }

    public function loadModelView(View $view, Model $model) {
        $this->view = $view;
        $this->model = $model;
    }

    // Will be using Model methods to connect to db
    /*
    public function connectToDB() {
    }
     */

    // Create Model instance in this->model
    public function loadModel($mdl) {
        require "../model/Model.php";
        require "../model/{$mdl}.php";
        $this->model = new $mdl($this->dbh);

    }


}
