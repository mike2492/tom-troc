<?php

class BookController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $userManager = new UserManager();

        $books = $bookManager->findAll();
        $owners = [];
        foreach($books as $book){
            $owners[$book->getUserId()] = $userManager->findById($book->getUserId());
        }

        $this->render('book/index', ['books' => $books, 'owners' => $owners]);
    }
}