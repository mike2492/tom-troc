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

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $availability = $_POST['availability'] ?? '';

            if(empty($title)){
                $errors['title'] = "Titre requis";
            } elseif(mb_strlen($title) > 255){
                $errors['title'] = "Titre trop long";
            }

            if(empty($author)){
                $errors['author'] = "Auteur requis";
            } elseif(mb_strlen($author) > 255){
                $errors['author'] = "Auteur trop long";
            } 

        
            if(empty($description)){
                $errors['description'] = "Description requis";
            }

            if($availability !== 'available' && $availability !== 'unavailable'){
                $errors['availability'] = "Disponibilité invalide";
            }

            if(empty($errors)){
                $book->setTitle($title);
                $book->setAuthor($author);
                $book->setDescription($description);
                $book->setAvailability($availability);
                $bookManager->update($book);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
        }

        $this->render('account/book_form', ['book' => $book, 'errors' => $errors]);
    }

    public function deleteBook(){
        $this->requireAuth();
        $bookManager = new BookManager();
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if($id === false || $id === null){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $book = $bookManager->findById($id);
        if($book === null || $book->getUserId() !== (int) $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $bookManager->delete($id);
        header('Location: index.php?controller=account&action=index');
        exit;
    }
}