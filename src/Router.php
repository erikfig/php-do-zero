<?php

namespace ErikFig\Framework;

class Router
{
    private $routes = [];
    private $method;
    private $path;
    private $params;

    public function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    public function get(string $route, $action)
    {
        return $this->add('GET', $route, $action); // adicionei o return
    }

    public function post(string $route, $action)
    {
        return $this->add('POST', $route, $action); // adicionei o return
    }

    public function add(string $method, string $route, $action)
    {
        $this->routes[$method][$route] = new RouteEntity($action); // usei nossa nova classe
        return $this->routes[$method][$route]; // adicionei o return
    }

    public function getParams()
    {
        return $this->params;
    }

    public function handler()
    {
        if (empty($this->routes[$this->method])) {
            return false;
        }

        if (isset($this->routes[$this->method][$this->path])) {
            return $this->routes[$this->method][$this->path];
        }

        foreach ($this->routes[$this->method] as $route => $action) {
            $result = $this->checkUrl($route, $this->path);
            if ($result >= 1) {
                return $action;
            }
        }

        return false;
    }

    private function checkUrl(string $route, $path)
    {
        preg_match_all('/\{([^\}]*)\}/', $route, $variables);

        $regex = str_replace('/', '\/', $route);

        foreach ($variables[0] as $k => $variable) {
            $replacement = '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variable, $replacement, $regex);
        }

        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);
        $result = preg_match('/^' . $regex . '$/', $path, $params);
        $this->params = $params;

        return $result;
    }
}
