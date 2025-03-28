<?php

use App\Config\Router;

Router::get('/', 'LoginController@register');
Router::get('/greet/{name}', function ($name) {
    echo "Hello $name";
});
