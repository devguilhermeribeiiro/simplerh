<?php

namespace App\Config;

use App\Controllers\LoginController;

class Router
{
    private static $_routes;

    private static function add($method, $path, $callback)
    {
        self::$_routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'callback' => $callback
        ];
    }

    public static function get($path, $callback)
    {
        self::add('GET', $path, $callback);
    }

    public static function post($path, $callback)
    {
        self::add('POST', $path, $callback);
    }

    public static function put($path, $callback)
    {
        self::add('PUT', $path, $callback);
    }

    public static function delete($path, $callback)
    {
        self::add('DELETE', $path, $callback);
    }

    public static function run()
    {
        $parsed_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$_routes as $route) {

            $route_pattern = '#^' . preg_replace('/\{([\w]+)\}/', '([^/]+)', $route['path']) . '$#';
            $url_params = [];

            if ($route['method'] === $request_method && preg_match($route_pattern, $parsed_url, $url_params)) {

                array_shift($url_params);

                if (is_callable($route['callback'])) {
                    call_user_func_array($route['callback'], $url_params);
                    return;

                } elseif (str_contains($route['callback'], '@')) {
                    [$route['controller'], $route['action']] = explode('@', $route['callback']);

                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controller_instance = new $controller();

                    call_user_func_array([ $controller_instance, $route['action'] ], $url_params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "Page not found";
    }
}
