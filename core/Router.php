<?php

namespace App\core;

use App\core\Request;
use App\core\Application;
use Exception;

class Router {
    
    public $request;
    public $response;
    protected $routes = [];

    public function __construct(Request $request,Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        try {
            $method = $this->request->getMethod();

            $path = $this->request->getPath();
            $callback = $this->routes[$method][$path] ?? false;
    
            if($callback == false) {
                $this->response->setStatusCode(404);
                return $this->renderViews('404');
                exit;
            }
    
            if(is_string($callback)) {
                return $this->renderViews($callback);
            }
            if(is_array($callback)) {
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;
            }
            
            return call_user_func($callback, $this->request);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function renderViews($fileName, $params = []) {
        $layOutContent = $this->renderLayouts();
        $renderOnlyViews = $this->renderOnlyViews($fileName , $params);
        $data = str_replace('{{content}}', $renderOnlyViews, $layOutContent);
        echo $data;
    }

    protected function renderOnlyViews($fileName, $params)
    {
        foreach($params as $key => $value) {    
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/Views/$fileName.php";
        return  ob_get_clean();
    }

    protected function renderLayouts()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/Views/layouts/$layout.php";
        return ob_get_clean();
    }
}