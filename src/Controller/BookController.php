<?php

class BookController extends Controller
{

    public function list(): void{

        $search = null;
        $bookManager = new BookManager();

        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }

        $books = $bookManager->findAll($search);
        $this->render('book/list', ['books' => $books, 'search' => $search]);
    }

    public function show(): void{
        $id = (int) $_GET['id'];

        $bookManager = new BookManager();

        $book = $bookManager->findById($id);

        if ($book === null) {
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        $userManager = new UserManager();
        $owner = $userManager->findById($book->getUserId());

        $this->render('book/show', ['book' => $book, 'owner' => $owner]);
    }

    public function edit() : void{
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $book = null;
        $bookManager = new BookManager();
        
        if(isset($_GET['id'])){
            $id = (int) $_GET['id'];
            $book = $bookManager->findById($id);

            if($book === null){
                header('Location: index.php?controller=book&action=list');
                exit;
            }

            if($book->getUserId() !== $_SESSION['user_id']){
                header('Location: index.php?controller=book&action=list');
                exit;
            }
        }

        $this->render('book/edit', ['book' => $book]);
    }

    public function save() : void{
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $description = trim($_POST['description']);
            $available = $_POST['available'];
            $id = isset($_POST['id']) && $_POST['id'] !== '' ? (int) $_POST['id'] : null;

            if(empty($title)){
                $errors['title'] = "Le titre est requis";
            }

            if(empty($author)){
                $errors['author'] = "L'auteur est requis";
            }

            if(empty($description)){
                $errors['description'] = "La description est requise";
            }

            if(empty($errors)){
                $bookManager = new BookManager();

                if($id !== null){
                    $book = $bookManager->findById($id);
                    if($book === null || $book->getUserId() !== $_SESSION['user_id']){
                        header('Location: index.php?controller=book&action=list');
                        exit;
                    }
                } else {
                    $book = new Book();
                    $book->setUserId($_SESSION['user_id']);
                }

                $book->setTitle($title);
                $book->setAuthor($author);
                $book->setDescription($description);
                $book->setAvailable($available);

                if($book->getId() !== null){
                    $bookManager->update($book);
                } else {
                    $bookManager->create($book);
                }
                
                header('Location: index.php?controller=user&action=account');
                exit;
            }
        }

        $this->render('book/edit', ['book' => null, 'errors' => $errors]);
    }

    public function delete(){
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if(isset($_GET['id'])){
            $id = (int) $_GET['id'];

            $bookManager = new BookManager();
            $book = $bookManager->findById($id);

            if($book !== null && $book->getUserId() === $_SESSION['user_id']){
                $bookManager->delete($id);
                header('Location: index.php?controller=user&action=account');
                exit;
            }

            header('Location: index.php?controller=user&action=account');
            exit;
        }
    }
}