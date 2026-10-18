<?php

class AccountController extends Controller{

    public function index(){

        $this->requireLogin();

        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user, 'books' => $books]);
    }
}