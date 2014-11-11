<?php

require_once "../view/view.php";

class App {
    
    public $page = "home";
    public $method = null;

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
        $this->router = new Router();

        zzz("Routes", $this->router->showURL());

        /*
         *
         * No need to check for request method here.  
         * class Router redirects based on routes
         */ 

        // returns page based on request URI
        //$request_method = $_SERVER['REQUEST_METHOD'];
        //echo $request_method;
        //if ($request_method == 'GET') {
        //    $controller_mod = 'get_controller';
        //} else if ($request_method == 'POST') {
        //    $controller_mod = 'post_controller';
        //}
        //
        //
        // DELETE

        $this->page = $this->router->grab_controller();
        $this->method = $this->router->get_method();

        $path = __DIR__ . "/../controller/" . $this->page . ".php";
        if (file_exists($path)) {
            require_once $path;
            // Class contructs are case insensitive.
            $this->controller = new $this->page;
            $this->controller->{$this->method}();
        } else {
            print '<p>' . urldecode($this->page) . '</p>';
            print '<p>server:' . $_SERVER['SERVER_NAME'] . '</p>';
            print "<p>404</p>";
        }
    }
}
