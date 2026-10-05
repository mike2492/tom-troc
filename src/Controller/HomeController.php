<?php

class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $books = $bookManager->findLatest(4);

        $userManager = new UserManager();
        $owners = [];

        foreach($books as $book){
            if(!isset($owners[$book->getUserId()])){
                $owners[$book->getUserId()] = $userManager->findById($book->getUserId());
            }
        }

        $this->render('home/index', ['title' => 'Accueil', 'books' => $books, 'owners' => $owners]);
    }
}