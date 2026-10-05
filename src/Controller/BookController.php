<?php

class BookController extends Controller{

    public function create(){
        $this->requireAuth();
        $errors = [];

        $bookManager = new BookManager();

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
                $errors['description'] = "Description requise";
            }

            if($availability !== 'available' && $availability !== 'unavailable'){
                $errors['availability'] = "Disponibilité Invalide";
            }

            if(empty($errors)){
                $book = new Book();
                $book->setTitle($title);
                $book->setAuthor($author);
                $book->setDescription($description);
                $book->setAvailability($availability);
                $book->setUserId($_SESSION['user_id']);
                $bookManager->create($book);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
        }

        $this->render('book/form', ['title' => 'Ajouter un livre', 'errors' => $errors]);
    }

    public function edit(){
        $this->requireAuth();
        $id = (int) ($_GET['id'] ?? 0);
        $bookManager = new BookManager();
        
        $book = $bookManager->findById($id);
        if($book === null || $book->getUserId() !== $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $errors = [];

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
                $errors['description'] = "Description requise";
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

        $this->render('book/form', ['title' => 'Modifier les informations', 'book' => $book, 'errors' => $errors]);
    }
}