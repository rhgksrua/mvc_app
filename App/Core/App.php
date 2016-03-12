<?php

namespace Hankmvc\App\Core;

use \Hankmvc\App\View\View as View;
use \Hankmvc\App\Model\Model as Model;
use \Hankmvc\App\Core\Router as Router;
use \Hankmvc\App\Controller\Controller as Controller;

/**
 *
 */
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
     * @param Router $router
     * @param View $view
     * @param Model $model
     *
     * @return
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
     * @param string $path Path to controller directory
     *
     * @return View $this->view->render($thi
     *
     * NOTE: Need to decide how 404 gets called.
     * It used to be that if controller file did not exist, users were redirected to 404.
     * Might need to redirect if uri does not exist in routes.php
     */
    private function routeToPath($path) {
        if (file_exists($path)) {
            $controllerName = CONTROLLER_NS . $this->controllerName;

            // create controller
            try {
                $this->controller = new $controllerName();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // load view and model
            $this->controller->loadModelView($this->view, $this->model);

            // call controller method
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



// EOF
