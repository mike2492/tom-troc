<?php

class Router{

    public function run(){

        $controller = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index'; 
        
        if(!is_string($controller) || !is_string($action)){
            echo "Format non valide";
            return;
        }

        if(!preg_match('/^[a-zA-Z]+$/D', $controller) || !preg_match('/^[a-zA-Z]+$/D', $action)){
            echo "Le format de controller et action n'est pas valide";
            return;
        }

        $controllerClass = ucfirst($controller) . 'Controller';

        if(class_exists($controllerClass)){
            $controllerInstance = new $controllerClass();
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