<?php

spl_autoload_register(function ($class) {
    $directories = [
        __DIR__ . '/../Model/Entity/',
        __DIR__ . '/../Model/Manager/',
        __DIR__ . '/../Controller/',
        __DIR__ . '/../Core/',
    ];

    foreach($directories as $dir){
        if(file_exists($dir . $class . '.php')){
            require($dir . $class . '.php');
            return;
        }
    }
});