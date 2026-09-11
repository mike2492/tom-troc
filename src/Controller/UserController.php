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

    public function publicProfile(){
        
        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        
        $user = $userManager->findById($id);

        if($user === null){
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $this->render('user/public', ['user' => $user, 'books' => $books]);
    }
}