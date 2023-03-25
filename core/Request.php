<?php

namespace App\core;

class Request {

    private $server = [];

    public function __construct()
    {
        $this->server = $_SERVER;
    }

    public function getPath()
    {
        $uri = $this->server["REQUEST_URI"];
        $position = strpos($uri, '?');
        if (!$position) {
            return $uri;
        } 

        return substr($uri, 0, $position);

    }

    public function getMethod()
    {
        $method = $this->server["REQUEST_METHOD"];
        return strtolower($method);
    }

    public function getBody()
    {
        $body = [];

        if ($this->getMethod() === 'get') {
            foreach($_GET as $key => $value)
            {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->getMethod() === 'post') {
            foreach($_POST as $key => $value)
            {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function isGet()
    {
        return $this->getMethod() === 'get';
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }
}