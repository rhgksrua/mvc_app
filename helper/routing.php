<?php


class Router {

    static private $sites = array();
    private $controller = null;
    private $uris = null;
    private $method = null;

    static private $method_types = array('get', 'post');


    // Will contain uri without script name
    private $requestURI = null;

    // Script name
    private $scriptName = null;

    // Parses URI and sets page
    public function __construct() {

        // Store all uri into self::$sites
        require "routes.php";

        // parse request uri
        $no_query = strtok($_SERVER['REQUEST_URI'], "?");
        $this->requestURI = explode('/', $no_query);
        $this->scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        for ($i = 0; $i < sizeof($this->scriptName); $i++) {
            if ($this->requestURI[$i] == $this->scriptName[$i]) {
                unset($this->requestURI[$i]);
            }
        }
        $this->requestURI = array_values($this->requestURI);

        // URI string. ex: /home/hangman
        $imploded = '/' . implode('/', $this->requestURI);
        zzz('$implode', $imploded);

        $request_method = strtolower($_SERVER['REQUEST_METHOD']);
        zzz('$request_method', $request_method);
        

        if (array_key_exists($request_method, self::$sites) && 
            array_key_exists($imploded, self::$sites[$request_method])) {

            $cont = self::$sites[$request_method][$imploded];
            $cont = explode('@', $cont);

            $this->set_controller($cont[0]);
            if (isset($cont[1]) && !empty($cont[1])) {
                $this->set_method($cont[1]);
            } else {
                $this->set_method();
            }

            zzz('controller', $this->controller);
            zzz('method', $this->method);
            

        } else {
            zzz("<p>uri DOES NOT exist</p>", "");
        }
    }

    // Controller Setter
    private function set_controller($cont) {
        $this->controller = $cont;
    }

    // Method Setter
    private function set_method($method = 'index') {
        $this->method = $method;

    }

    public function grab_controller() {
        return $this->controller;
    }

    public function get_controller() {
        return $this->controller;
    }

    public function get_method() {
        return $this->method;

    }

    static public function __callStatic($method, $arg) {
        if (in_array($method, self::$method_types)) {
            self::$sites[$method][$arg[0]] = $arg[1];
        } else {
            echo "request method invalid";
        }
    }

    public function showURL() {
        return self::$sites;
    }

}
