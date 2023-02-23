<?php

class App 
{
    public $controller = 'Redirector';
    public $method = 'index';
    public $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * membuat request url menjadi array
     * contoh http://localhost/public/user/edit/3/
     * menjadi ['user','edit','2']
     * 
     * @return array
     */
    public function parseURL()
    {
        $url = $_GET['url'] ?? null;

        if ($url == null) {
            return [$this->controller, $this->method];
        }

        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        return $url;
    }
}