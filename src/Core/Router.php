<?php

class Router{
    
   public function run(){

        $controller = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index';

        if(!is_string($controller) || !is_string($action) || !preg_match('/^[a-zA-Z]+$/', $controller) || !preg_match('/^[a-zA-Z]+$/', $action)){
            $this->notFound();
            return;
        }

        $controllerClass = ucfirst($controller) . 'Controller';

        if(class_exists($controllerClass) && is_subclass_of($controllerClass, 'Controller')){

            $controllerInstance = new $controllerClass();

            if(is_callable([$controllerInstance, $action])){
                $controllerInstance->$action();
            } else{
                $this->notFound();
            }

        } else{
            $this->notFound();
        }

    }

   private function notFound(){
        http_response_code(404);
        echo "Page Introuvable";
   }
        
}