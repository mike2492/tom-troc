<?php

class AccountController extends Controller{

    public function index(){
        $this->requireAuth();
        $userManager = new UserManager();

        $user = $userManager->findById($_SESSION['user_id']);

        if($user === null){
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        
        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user]);
    }
}