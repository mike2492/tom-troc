<?php
// Loads a class file automatically the first time the class is used,
// so no manual require is needed for controllers, entities or managers.
spl_autoload_register(function($class){
    // Folders searched, in order.
    $paths = [
        __DIR__ . '/',
        __DIR__ . '/../Controller/',
        __DIR__ . '/../Model/Entity/',
        __DIR__ . '/../Model/Manager/'
    ];

    foreach($paths as $path){
        if(file_exists($path . $class . '.php')){
            require_once $path . $class . '.php';
            return;
        }     
    }
});