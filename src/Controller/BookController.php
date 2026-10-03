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
}