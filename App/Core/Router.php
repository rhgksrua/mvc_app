<?php

namespace Hankmvc\App\Core;

/**
 * Pretty URLs
 * 
 * Router class parses controller and method for each routes provided from routes.php
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
     * Converts request uri in to an array
     *
     * @return array
     */
    public function getUriArray() {
        $noQuery = strtok($_SERVER['REQUEST_URI'], "?");
        return explode('/', $noQuery);
    }

    /**
     * Filters empty element from $uri based on $_SERVER['SCRIPT_NAME']
     *
     * @param array $uri
     *
     * @return array
     */
    public function filterEmptyElement($uri) {
        $this->scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        for ($i = 0; $i < sizeof($this->scriptName); $i++) {
            if ($uri[$i] == $this->scriptName[$i]) {
                unset($uri[$i]);
            }
        }
        return array_values($uri);
    }

    /**
     * parseUri sets controller and method based on routes.php.
     *
     * @param
     *
     * @return void
     */
    private function parseUri() {

        // get all the routes
        require APP . 'routes.php';

        // parse request uri
        $this->requestURI = $this->getUriArray();

        // reset array index
        $this->requestURI = array_values($this->requestURI);

        // requestURI now holds parsed uri in array
        $this->requestURI = $this->filterEmptyElement($this->requestURI);

        // URI string. ex: /home/hangman
        $imploded = '/' . implode('/', $this->requestURI);

        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
        
        $this->setControllerMethod($requestMethod, $imploded);

    }

    /**
     * Sets routes based on routes.php
     *
     * @param string $requestMethod Request method specified
     * @param string $imploded      Requested URI
     *
     * @return void
     */
    private function setControllerMethod($requestMethod, $imploded) {
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
     * sets controller called from routes.php
     *
     * @param string $controller
     *
     * @return void
     */
    private function setController($controller) {
        $this->controller = $controller;
    }

    /**
     * set method called from routes.php
     *
     * @param string $method
     *
     * @return void
     */
    private function setMethod($method = 'index') {
        $this->method = $method;
    }

    /**
     * get controller name
     *
     * @param
     *
     * @return string $this->controller
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * Get method name. Default name is 'index'
     *
     * @param
     *
     * @return string $this->method
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Magic method. Determines request method.
     *
     * @param string $method
     * @param array $arg
     *
     * @return void
     */
    public function __call($method, $arg) {
        if (in_array($method, $this->methodTypes)) {
            $this->sites[$method][$arg[0]] = $arg[1];
        } else {
            throw new Exception("request method ( $method ) in routes.php invalid");
            exit();
        }
    }

    /**
     * Returns current URL
     *
     * @param
     *
     * @return void
     */
    public function getURL() {
        return $this->sites;
    }
}
