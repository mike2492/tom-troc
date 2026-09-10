<?php
require_once __DIR__ . '/../src/Core/Autoloader.php';
require_once __DIR__ . '/../config/config.php';

$router = new Router();
$router->run();