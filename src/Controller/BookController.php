<?php

class BookController extends Controller{

    public function add(){
        $this->requireLogin();

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = trim($_POST['title'] ?? '');
            $author = trim($_POST['author'] ?? '');
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? '';

            if($title === ''){
                $errors['title'] = "Titre requis";
            }

            if($author === ''){
                $errors['author'] = "Auteur requis";
            }

            if($description === ''){
                $errors['description'] = "Description requise";
            }

            if(!in_array($status, ['available', 'unavailable'], true)){
                $errors['status'] = "Disponibilité non valide";
            }

            if(empty($errors)){
                $bookManager = new BookManager();
                $book = new Book([
                    'title' => $title,
                    'author'=> $author,
                    'description' => $description,
                    'status' => $status,
                    'user_id' => $_SESSION['user_id']
                ]);

                $bookManager->create($book);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
        }

        $this->render('book/form', ['title' => 'Ajouter un livre', 'errors' => $errors]);
    }

    public function edit(){
        $this->requireLogin();
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
            $description = $_POST['description'] ?? '';
            $status = $_POST['status'] ?? '';

            if($title === ''){
                $errors['title'] = "Titre requis";
            }

            if($author === ''){
                $errors['author'] = "Auteur requis";
            }

            if($description === ''){
                $errors['description'] = "Description requise";
            }

            if(!in_array($status, ['available', 'unavailable'], true)){
                $errors['status'] = "Disponibilité non valide";
            }

            if(empty($errors)){
                $book->setTitle($title);
                $book->setAuthor($author);
                $book->setDescription($description);
                $book->setStatus($status);

                $bookManager->update($book);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
        }
        
        $this->render('book/form', ['title' => 'Modifier les informations', 'book' => $book, 'errors' => $errors]);
    }

    public function delete(){
        $this->requireLogin();
        $id = (int) ($_GET['id'] ?? 0);

        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null || $book->getUserId() !== $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $bookManager->delete($id);
        header('Location: index.php?controller=account&action=index');
        exit;
    }
    
    public function index(){
        $bookManager = new BookManager();
        $search = $_GET['search'] ?? '';
        
        if(!is_string($search)){
            $search = '';
        }

        $search = mb_substr(trim($search), 0, 100);

        if($search === ''){
            $books = $bookManager->findAll();
        } else{
            $books = $bookManager->searchByTitle($search);
        }

        $userManager = new UserManager();
        $owners = [];

        foreach($books as $book){
            $owner = $userManager->findById($book->getUserId());
            $owners[$book->getId()] = $owner->getUsername();       
        }

        $this->render('book/index', ['title' => 'Nos livres à l\'échange', 'books' => $books, 'owners' => $owners, 'search' => $search]);
    }
}