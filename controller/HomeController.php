<?php

use \Hankmvc\controller\Controller as Controller;

class HomeController extends Controller {
    public function index($page = 'home') {
        return $this->view->render('home');
    }
}

// END
