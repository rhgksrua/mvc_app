<?php

class Home extends Controller {

    private $page_var = array();

    public function index($page = "home") {

        if (isset($_GET['test'])) {
            $this->page_var["test"] = $_GET['test'];
        } else {
            $this->page_var["test"] = "";
        }

        $this->page_var["name"] = "bob";

        $this->connectToDB();
        $this->loadModel("HomeModel");
        $this->model->test();

        return View::render($page, $this->page_var);
    }
}

// END
