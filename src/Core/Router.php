<?php

class Router{

    public function run(){

        if(!isset($_GET['controller']) || !isset($_GET['action'])){
            echo "Paramètres manquants";
            exit;
        }

        $controller = $_GET['controller'];
        $action = $_GET['action'];

        $controllerClass = ucfirst($controller) . 'Controller';
        if(class_exists($controllerClass)){
            $controllerInstance = new $controllerClass();
            if(method_exists($controllerInstance, $action)){
                $controllerInstance->$action();
            } else{
                echo "La méthode n'existe pas";
            }

        } else{
            echo "La classe n'existe pas";
        }
    }
}