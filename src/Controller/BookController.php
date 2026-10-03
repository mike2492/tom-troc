<?php

class BookController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $userManager = new UserManager();

        $search = trim($_GET['search'] ?? '');

        if(empty($search)){
            $books = $bookManager->findAll();
        } else{
            $books = $bookManager->searchByTitle($search);
        }

    
        $owners = [];
        foreach($books as $book){
            if(!isset($owners[$book->getUserId()])){
                $owners[$book->getUserId()] = $userManager->findById($book->getUserId());
            }
        }

        $this->render('book/index', ['books' => $books, 'owners' => $owners, 'search' => $search]);
    }

    public function show(){
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if($id === false || $id === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $bookManager = new BookManager();
        $book = $bookManager->findById($id);

        if($book === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $userManager = new UserManager();
        $owner = $userManager->findById($book->getUserId());

        $this->render('book/show', ['book' => $book, 'owner' => $owner]);
    }
}