<?php
class Router{
    
    public function run(){
        if(!isset($_GET['controller']) || !isset($_GET['action'])){
            echo "Paramètres manquants";
            return;
        }

        $controller = $_GET['controller'];
        $action = $_GET['action'];

        $controllerName = ucfirst($controller) . 'Controller';
        if(class_exists($controllerName)){
            $controllerInstance = new $controllerName();
            if(method_exists($controllerInstance, $action)){
                $controllerInstance->$action();
            } else{
                echo "La méthode n'existe pas"; 
                return;
            }
        } else{
            echo "La classe n'existe pas";
            return;
        }
    }
}