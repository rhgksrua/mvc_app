<?php

namespace Hankmvc\App\Controller;

use \Hankmvc\App\View\View as View;
use \Hankmvc\App\Model\Model as Model;


/**
 *
 * Controller class
 *
 */
class Controller 
{

    // PDO instance
    public $dbh = null;

    // model for controller
    public $model = null;
    public $view = null;

    /**
     * constructor
     */
    public function __construct() 
    {

    }

    /**
     * Set Model and View
     *
     * @param View $view
     * @param Model $model
     *
     * @return void
     */
    public function loadModelView(View $view, Model $model) 
    {
        $this->view = $view;
        $this->model = $model;
    }
}

// EOF
