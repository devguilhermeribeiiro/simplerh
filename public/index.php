<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Config\Router;

require __DIR__ . '/../src/Web/Routes.php';

$db = new Database();
$db->connect();

Router::run();
