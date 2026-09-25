<?php
class BookController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $search = trim($_GET['search'] ?? '');

        if(empty($search)){
            $books = $bookManager->findAll();
        } else{
            $books = $bookManager->searchByTitle($search);
        }

        $this->render('book/index', ['title' => "Nos livres à l'échange", 'books' => $books, 'search' => $search]);
    }

    public function show(){
        $id = (int) $_GET['id'];
        $bookManager = new BookManager();
        $userManager = new UserManager();
        $book = $bookManager->findById($id);
        if($book === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $owner = $userManager->findById($book->getUserId());
        $this->render('book/show', ['title' => $book->getTitle(), 'book' => $book, 'owner' => $owner]);
    }
}