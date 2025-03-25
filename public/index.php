<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;

$db = new Database();

$db->connect();

echo "<h1>Olá, Mundo!</h1>";
