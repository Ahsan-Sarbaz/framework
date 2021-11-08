<?php

namespace Jin\Core;

class Router
{

    public Request $request;
    public array $routes = [];


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $url, $callback)
    {
        $this->routes['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routes['post'][$url] = $callback;
    }


    public function resolve()
    {
        $method = $this->request->method();
        $url = $this->request->url();
        $callback = $this->routes[$method][$url] ?? false;
        
        if($callback === false)
        {
            return 'NOT FOUND';
        }

        if(is_string($callback))
        {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $callback[0] = $controller;
        }

        return call_user_func($callback, $this->request);
    }

    public function renderView($view)
    {
        return $view;
    }
};

?>