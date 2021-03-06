<?php

namespace Hankmvc\App\View;

/**
 * handles all template related operations
 *
 * default directory '/view/template/'
 *
 * @param string $templateDir specify template directory
 */
class View {

    /**
     * sets template directory
     */
    public function __construct($templateDir = TEMPLATE) {
        $this->templateDir = $templateDir;
    }

    /**
     * Renders html templates
     *
     * Looks for files under /view/template/
     *
     * @param string $template - name of the template
     * @param array $data - any varialbes required by the tempalate
     *
     * @return void
     */
    public function render($template, $data = array()) {

        $path = dirname(__DIR__) . $this->templateDir . $template . '.php';
        $path = $this->templateDir . $template . '.php';
        if (file_exists($path)) {
            extract($data);
            require($path);
        } else {
            throw new \Exception("View template not found");
        }
    }
}
