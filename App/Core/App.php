<?php

namespace Hankmvc\App\Core;

use \Hankmvc\App\View\View as View;
use \Hankmvc\App\Model\Model as Model;
use \Hankmvc\App\Core\Router as Router;
use \Hankmvc\App\Controller\Controller as Controller;

class App {
    private $page404 = '404';
    
    // Controller and its method
    private $controllerName = "home";
    private $method = null;

    // File path for controller
    private $path = null;

    // Following var hold instances of its respective class
    private $controller = null;
    private $model = null;
    private $router = null;
    private $view = null;

    /**
     * This is where it begins
     * Initializes required classes.
     *
     * @param $router Router
     * @param $view View
     * @param $model Model
     */
    public function __construct(Router $router, View $view, Model $model) {
        $this->router = $router;
        $this->view = $view;
        $this->model = $model;
        $this->controllerName = $this->router->getController();
        $this->method = $this->router->getMethod();
        $path = dirname(__DIR__) . "/Controller/" . $this->controllerName . ".php";
        $this->routeToPath($path);
    }

    /**
     * Creates controller and invokes required method
     * 
     * @param $path string Path to controller directory
     *
     * NOTE: Need to decide how 404 gets called.
     * It used to be that if controller file did not exist, users were redirected to 404.
     * Might need to redirect if uri does not exist in routes.php
     */
    private function routeToPath($path) {
        //echo $path;
        if (file_exists($path)) {
            $controllerName = CONTROLLER_NS . $this->controllerName;

            //var_dump($controllerName);

            try {
                $this->controller = new $controllerName();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // Class View and Model is required by user created Controller
            // class.  loadModelView method makes these classes available.
            $this->controller->loadModelView($this->view, $this->model);
            try {
                $this->controller->{$this->method}();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            exit();
        } else {
            return $this->view->render($this->page404);
        }
    }
}



// END
