<?php

namespace Hankmvc\App\Controller;

use \Hankmvc\App\Controller\Controller as Controller;

class HomeController extends Controller {
    public function index($page = 'home') {
        return $this->view->render('home');
    }
    public function test($page = 'home') {
        return $this->view->render('home');
    }
}

// END
