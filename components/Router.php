<?php

class Router
{
    private $routes = ['student/([0-9]+)' => 'StudentController/show/$1'];

    private function getUrl()
    {
        return trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run()
    {
        foreach ($this->routes as $pattern => $controller) {

            if(preg_match("~$pattern~", $this->getUrl())) {
                $route = preg_replace("~$pattern~", $controller, $this->getUrl());
                $routeSegments = explode('/', $route);
                $controllerName = array_shift($routeSegments);
                $controllerAction = array_shift($routeSegments);
                $controller = new $controllerName;
                $result = call_user_func_array([$controller, $controllerAction], $routeSegments);
            } else {
                echo 'Undefined route.';
            }
        }
    }
}