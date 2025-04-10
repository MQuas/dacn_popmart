<?php
namespace app\core;
class Router {
    private $routes = [];

    public function add($route, $params = []) {
        // Chuyển {param} thành regex để khớp với URL
        $route = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $route);
        $route = '#^' . $route . '$#'; 
        $this->routes[$route] = $params;
    }

    public function match($url) {
        // Loại bỏ query string (phần sau dấu ?)
        // $url = parse_url($url, PHP_URL_PATH);
        // $url = explode("?", $url)[0];
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Lấy các tham số từ regex
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                return $params;
            }
        }
        return false;
    }
}


