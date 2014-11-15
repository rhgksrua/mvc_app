<?php

require_once "../view/view.php";

class App {
    private $page404 = '404';
    
    private $controllerName = "home";
    private $method = null;

    // File path for controller
    private $path = null;

    // All the required classes
    private $controller = null;

    // if required
    private $model = null;

    // routes based on request URI
    private $router = null;

    // Routing
    public function __construct() {

        // routing class
        // Dependency on Router class
        $this->router = new Router();

        zzz("Routes", $this->router->showURL());

        $this->controllerName= $this->router->get_controller();
        $this->method = $this->router->get_method();

        $path = __DIR__ . "/../controller/" . $this->controllerName. ".php";
        zzz('path: ', $path);
        if (file_exists($path)) {
            require_once $path;
            // Class contructs are case insensitive.
            // Dependency on controller class
            $this->controller = new $this->controllerName;
            $this->controller->{$this->method}();
        } else {
            return View::render($this->page404);
        }
    }
}

// Factory
function startApp() {
    zzz('Starting App', '');
    return new App();
}

// END
