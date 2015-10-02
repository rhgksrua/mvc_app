<?php

require_once "../view/View.php";

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
        $this->controllerName= $this->router->getController();
        $this->method = $this->router->getMethod();
        $path = dirname(__DIR__) . "/controller/" . $this->controllerName . ".php";
        $this->routeToPath($path);
    }

    /**
     * Creates controller and invokes required method
     * 
     * @param $path string Path to controller directory
     *
     * NOTE: need to rework how controller is being created
     */
    private function routeToPath($path) {
        if (file_exists($path)) {
            require_once $path;

            try {
                $this->controller = new $this->controllerName();
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
