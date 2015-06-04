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
        $path = __DIR__ . "/../controller/" . $this->controllerName. ".php";
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
            $this->controller = new $this->controllerName();

            // Injecting view and model
            $this->controller->setModelView($this->view, $this->model);
            $this->controller->{$this->method}();
            exit();
        } else {
            return $this->view->render($this->page404);
        }
    }
}



// END
