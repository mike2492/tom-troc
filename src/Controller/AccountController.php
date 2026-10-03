<?php

class AccountController extends Controller{

    public function index(){
        $this->requireAuth();
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);

        if($user === null){
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $this->render('account/index', ['user' => $user, 'books' => $books]);
    }

    public function editBook(){
        $this->requireAuth();
        $bookManager = new BookManager();
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if($id === false || $id === null){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $errors = [];
        $book = $bookManager->findById($id);
        if($book === null || $book->getUserId() !== (int) $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $this->render('account/book_form', ['book' => $book, 'errors' => $errors]);
    }
}