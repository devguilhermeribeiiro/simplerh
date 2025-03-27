<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Config\Router;

require __DIR__ . '/../src/web/Routes.php';

$db = new Database();

$db->connect();
echo "<br>";
Router::run();
