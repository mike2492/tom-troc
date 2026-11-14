<?php

// Home page: shows the latest books added.
class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $books = $bookManager->findLatest(4);

        $userManager = new UserManager();

        // Owner names indexed by book id, used for "Vendu par".
        $owners = [];
        foreach($books as $book){
            $owner = $userManager->findById($book->getUserId());
            $owners[$book->getId()] = $owner->getUsername();
        }

        $this->render('home/index', ['title' => 'Accueil', 'books' => $books, 'owners' => $owners]);
    }
}