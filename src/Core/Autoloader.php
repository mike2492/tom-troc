<?php
spl_autoload_register(function($class){
    $paths = [
        __DIR__ . '/',
        __DIR__ . '/../Model/Entity/',
        __DIR__ . '/../Model/Manager/',
        __DIR__ . '/../Controller/'
    ];

    foreach($paths as $path){
        if(file_exists($path . $class . '.php')){
            require $path . $class . '.php';
            return;
        }
    }
});