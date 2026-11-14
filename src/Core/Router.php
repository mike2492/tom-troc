<?php

// Maps ?controller=X&action=Y to XController::Y().
class Router{

    public function run(){

        $controller = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index'; 
        
        // A parameter sent as an array (?controller[]=x) is rejected.
        if(!is_string($controller) || !is_string($action)){
            echo "Format non valide";
            return;
        }

        // Letters only: blocks path tricks like ../ and any special character.
        // The D modifier also rejects a trailing newline.
        if(!preg_match('/^[a-zA-Z]+$/D', $controller) || !preg_match('/^[a-zA-Z]+$/D', $action)){
            echo "Le format de controller et action n'est pas valide";
            return;
        }

        $controllerClass = ucfirst($controller) . 'Controller';

        if(class_exists($controllerClass)){
            $controllerInstance = new $controllerClass();
            // is_callable only accepts public methods, so protected helpers
            // such as render() or requireLogin() cannot be called from the URL.
            if(is_callable([$controllerInstance, $action])){
                $controllerInstance->$action();
            } else{
                echo "La méthode n'existe pas"; 
            }
        } else{
            echo "La classe n'existe pas";
        }
    }
}