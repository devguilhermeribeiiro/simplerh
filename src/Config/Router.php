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
        $parsed_url = $_SERVER['REQUEST_URI'];
        $request_method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$_routes as $route) {

            if (is_callable($route['callback'])) {
                call_user_func($route['callback']);

            } elseif (str_contains($route['callback'], '@')) {
                [$route['controller'], $route['action']] = explode('@', $route['callback']);

                $controller = 'App\\Controllers\\' . $route['controller'];

                if ($route['method'] === $request_method && $route['path'] === $parsed_url) {
                    call_user_func_array(
                        [ $controller, $route['action'] ],
                        []
                    );
                }
            }

        }
    }
}
