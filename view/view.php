<?php

class View {

    public function __construct() {

    }

    static public function render($template, $data = array()) {

        $path = __DIR__ . '/../view/template/' . $template . '.php';
        if (file_exists($path)) {
            extract($data);
            require($path);
        }
    }

}
