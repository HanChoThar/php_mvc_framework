<?php

namespace App\core;

class Application {

    public static $ROOT_DIR;
    public static $app;
    public $router;
    public $request;
    public $response;
    public $controller;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        return $this->router->resolve();
    }

    /**
     * @return \App\core\Controller
     */
    public function getController(): \App\core\Controller
    {
        return $this->controller;
    }

    /**
     * @param \App\core\Controller $controller
     */
    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

}