<?php

namespace Hankmvc\App\Controller;

use \Hankmvc\App\View\View as View;
use \Hankmvc\App\Model\Model as Model;

class Controller 
{

    // PDO instance
    public $dbh = null;

    // model for controller
    public $model = null;
    public $view = null;

    /**
     * Base controller
     * 
     */
    public function __construct() 
    {

    }

    /**
     * Gets View and Model from App
     *
     * @param View $view
     * @param Model $model
     */
    public function loadModelView(View $view, Model $model) 
    {
        $this->view = $view;
        $this->model = $model;
    }
}

// EOF
