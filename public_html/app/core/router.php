<?php

namespace app\core;

use app\controllers\CodesController;

class Router
{
    /**
     * Массив маршрутов и их обработчиков
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Параметры обработки текущего маршрута (controller, action и другие параметры)
     *
     * @var array
     */
    protected $params = [];

    public function __construct()
    {
        $routes = require 'app/config/routes.php';
        foreach ($routes as $route => $params) {           
            $this->addRoute($route, $params);
        }
    }

    /**
     * Добавляет маршруты в массив $routes в виде регулярных выражений
     *
     * @param string $route Маршрут
     * @param array $params Параметры маршрута
     * @return void
     */
    public function addRoute($route, $params) {
        $route = preg_replace('#{([a-z]+):([^\}]+)}#', '(?<\1>\2)', $route);
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * Определяет существование маршрута
     *
     * @return bool
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Запускает роутер
     */
    public function run()
    {
        if ($this->match()) {
            $path = 'app\controllers\\' . $this->params['controller'] . 'Controller';
            if (class_exists($path)) {
                $action = 'action' . ucfirst($this->params['action']);
                if (method_exists($path, $action)) {
                    new $path($this->params);
                    return;
                }
            } 
        }
        new CodesController(['action' => '404']);
    }
}
