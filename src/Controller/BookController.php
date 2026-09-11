<?php

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

    public function show(): void{
        $id = (int) $_GET['id'];

        $bookManager = new BookManager();

        $book = $bookManager->findById($id);

        if ($book === null) {
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        $userManager = new UserManager();
        $owner = $userManager->findById($book->getUserId());

        $this->render('book/show', ['book' => $book, 'owner' => $owner]);
    }
}