<?php

namespace App\core;

class Controller {

    public $layout = 'main';

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderViews($view, $params);
    }
}