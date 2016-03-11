<?php

namespace Hankmvc\App\Core;

/**
 * Pretty URLs
 */
class Router {

    private $sites = array();
    private $controller = null;
    private $uris = null;
    private $method = null;
    private $methodTypes = array('get', 'post');

    // Will contain uri without script name
    private $requestURI = null;

    // Script name
    private $scriptName = null;

    // Parses URI and sets page
    public function __construct() {
        $this->parseUri();
    }

    /**
     * Tries to match uri from routes.php
     */
    private function parseUri() {

        // get all the routes
        require APP . 'routes.php';

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

        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        

        if (array_key_exists($requestMethod, $this->sites) && 
            array_key_exists($imploded, $this->sites[$requestMethod])) {

            $cont = $this->sites[$requestMethod][$imploded];
            $cont = explode('@', $cont);

            $this->setController($cont[0]);
            if (isset($cont[1]) && !empty($cont[1])) {
                $this->setMethod($cont[1]);
            } else {
                $this->setMethod();
            }
        }
    }

    /**
     * sets controller for a route
     *
     * @param string $controller
     *
     * @return string
     */
    private function setController($controller) {
        $this->controller = $controller;
    }

    private function setMethod($method = 'index') {
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

    /**
     * Magic method
     *
     *
     */
    public function __call($method, $arg) {
        if (in_array($method, $this->methodTypes)) {
            $this->sites[$method][$arg[0]] = $arg[1];
        } else {
            throw new Exception("request method ( $method ) in routes.php invalid");
            exit();
        }
    }

    public function getURL() {
        return $this->sites;
    }
}
