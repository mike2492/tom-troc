<?php

class UserController extends Controller{

    public function account(): void{
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        
        $userManager = new UserManager();
        $user = $userManager->findById($_SESSION['user_id']);
        $this->render('user/account', ['user' => $user]);
    }
}