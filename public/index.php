<?php
// Single entry point: every request goes through this file.

// Must run before any output so $_SESSION is available everywhere.
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/Core/Autoloader.php';

// The router reads ?controller=...&action=... and calls the matching method.
$router = new Router();
$router->run();