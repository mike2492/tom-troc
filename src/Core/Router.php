<?php
class Router{

    public function run(){

        $controller = $_GET['controller'] ?? 'home';
        $action = $_GET['action'] ?? 'index';

        if(!preg_match('/^[a-zA-Z]+$/', $controller) || !preg_match('/^[a-zA-Z]+$/', $action)){
            $this->notFound();
        }

        $controllerClass = ucfirst($controller) . 'Controller';

        if(!class_exists($controllerClass)){
            $this->notFound();
        }

        $controllerInstance = new $controllerClass();

        if(!is_callable([$controllerInstance, $action])){
            $this->notFound();
        }

        $controllerInstance->$action();

    }   

    private function notFound(){
        http_response_code(404);
        echo "Page Introuvable";
        exit;
    }
}