<?php

/**
 *
 * Pretty URLs
 *
 */
class Router {

    private $sites = array();
    private $controller = null;
    private $uris = null;
    private $method = null;
    private $method_types = array('get', 'post');

    // Will contain uri without script name
    private $requestURI = null;

    // Script name
    private $scriptName = null;

    // Parses URI and sets page
    public function __construct() {

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

        $request_method = strtolower($_SERVER['REQUEST_METHOD']);
        

        if (array_key_exists($request_method, $this->sites) && 
            array_key_exists($imploded, $this->sites[$request_method])) {

            $cont = $this->sites[$request_method][$imploded];
            $cont = explode('@', $cont);

            $this->set_controller($cont[0]);
            if (isset($cont[1]) && !empty($cont[1])) {
                $this->set_method($cont[1]);
            } else {
                $this->set_method();
            }
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

    // Controller Getter
    public function getController() {
        return $this->controller;
    }

    // Method Setter
    public function getMethod() {
        return $this->method;
    }

    public function __call($method, $arg) {
        if (in_array($method, $this->method_types)) {
            $this->sites[$method][$arg[0]] = $arg[1];
        } else {
            throw new Exception("request method ( $method ) in routes.php invalid");
            exit();
        }
    }

    public function showURL() {
        return $this->sites;
    }

}
