<?php
session_start();
require __DIR__ . '/../config/config.php';
require __DIR__ . '/../src/Core/Autoloader.php';
$router = new Router();
$router->run();