<?php
class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $userManager = new UserManager();
        $books = $bookManager->findLatest(4);

        $owners = [];
        foreach($books as $book){
            $owners[$book->getId()] = $userManager->findById($book->getUserId());
        }

        $this->render('home', ['title' => 'Accueil', 'books' => $books, 'owners' => $owners]);
    }
}