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

    public function update(Book $book) : void{
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author = :author, description = :description, image = :image, status = :status WHERE id = :id");
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'status' => $book->getStatus(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : void{
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);
    }

    public function findAll() : array{
        $stmt = $this->db->query("SELECT * FROM books ORDER BY created_at DESC, id DESC");

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function searchByTitle(string $search) : array{
        $search = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);
        $stmt = $this->db->prepare("SELECT * FROM books WHERE title LIKE :search ORDER BY create_at DESC, id DESC");
        $stmt->execute([
            'search' => '%' . $search . '%'
        ]);

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function findLatest(int $limit) : array{
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        $books = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }
}