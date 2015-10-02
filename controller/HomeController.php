<?php

class HomeController extends Controller {

    public function index($page = 'home') {
        return $this->view->render('home');
    }
    public function test($page = 'test') {
        return $this->view->render('test');
    }
}

// END
