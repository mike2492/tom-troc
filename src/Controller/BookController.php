<?php
// src/Controller/BookController.php

class BookController extends Controller
{

    public function list(): void{

        $search = null;
        $bookManager = new BookManager();

        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }

        $books = $bookManager->findAll($search);
        $this->render('book/list', ['books' => $books, 'search' => $search]);
    }
}