<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

Database::connect();
echo "<h1>Olá, Mundo!</h1>";
