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

    // Routing
    public function __construct($router, $view) {
        // routing class
        // Dependency on Router class
        
        $this->router = $router;
        $this->view = $view;
        $this->controllerName= $this->router->getController();
        $this->method = $this->router->getMethod();
        $path = __DIR__ . "/../controller/" . $this->controllerName. ".php";
        $this->routeToPath($path);
    }

    /*
     *
     * Creates controller.
     *
     */
    private function routeToPath($path) {
        if (file_exists($path)) {
            require_once $path;
            // Class contructs are case insensitive.
            // Dependency on controller class
            $this->controller = new $this->controllerName();
            $this->controller->{$this->method}();
            exit();
        } else {
            return $this->view->render($this->page404);
        }
    }
}



// END
