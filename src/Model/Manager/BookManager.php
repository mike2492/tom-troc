<?php

class BookManager extends Manager{

    public function findByUserId(int $userId) : array{
        $stmt = $this->db->prepare("SELECT * FROM books WHERE user_id = :user_id");
        $stmt->execute([
            'user_id' => $userId
        ]);

        $books = [];
        $rows = $stmt->fetchAll();
        
        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function create(Book $book) : void{
        $stmt = $this->db->prepare("INSERT INTO books (title, author, description, image, status, user_id) VALUES (:title, :author, :description, :image, :status, :user_id)");
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'status' => $book->getStatus(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);
        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $book = new Book($row);

        return $book;
    }
}