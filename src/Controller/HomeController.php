<?php
class HomeController extends Controller{

    public function index(){
        $bookManager = new BookManager();
        $books = $bookManager->findLatest(4);

        $this->render('home', ['title' => 'Accueil', 'books' => $books]);
    }
}