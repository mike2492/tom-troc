<?php

class AccountController extends Controller{

    public function index(){
        $this->requireAuth();

        $userManager = new UserManager();
        $bookManager = new BookManager();


        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user, 'books' => $books]);
    }

    public function show(){
        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($id);

        if($user === null){
            header('Location: index.php?controller=home&action=index');
            exit;
        }

        $books = $bookManager->findByUserId($id);

        $this->render('account/show', ['title' => $user->getUsername(), 'user' => $user, 'books' => $books]);
    }
}