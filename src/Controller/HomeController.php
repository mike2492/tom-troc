<?php
class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $userManager = new UserManager();

        $books = $bookManager->findLatest(4);
        $owners = [];

        foreach($books as $book){
            $owners[$book->getUserId()] = $userManager->findById($book->getUserId());
        }

        $this->render('home/index', ['books' => $books, 'owners' => $owners]);
    }
}