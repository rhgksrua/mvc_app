<?php

class Home extends Controller {
    /**
     * NOTE: list of available var inherited from Controller
     * $this->model Model instance
     * $this->view View instance
     *
     */

    /**
     * Default Homepage
     *
     * @param $page string Name of the template
     */
    public function index($page = "home") {
        return $this->view->render($page);
    }
}

// END
