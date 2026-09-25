<?php

abstract class Controller{

    protected function render(string $view, array $data = []){
        extract($data);
        ob_start();
        require __DIR__  . '/../View/' . $view . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../View/main.php';
    }

    protected function requireAuth(){
        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
    }
}