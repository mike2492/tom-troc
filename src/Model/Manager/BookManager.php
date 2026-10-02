<?php

class BookManager extends Manager{

    public function findAll() : array{
        $stmt = $this->pdo->query('SELECT * FROM books ORDER BY created_at DESC');
        $rows = $stmt->fetchAll();

        $books = [];
        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function searchByTitle(string $title) : array{
        $stmt = $this->pdo->prepare('SELECT * FROM books WHERE title LIKE :title ORDER BY created_at DESC');
        $stmt->execute([
            'title' => '%' . $title . '%'
        ]);
        $rows = $stmt->fetchAll();

        $books = [];
        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function findLatest(int $limit) : array{
        $stmt = $this->pdo->prepare('SELECT * FROM books ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll();

        $books = [];
        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function findByUserId(int $userId) : array{
        $stmt = $this->pdo->prepare('SELECT * FROM books WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute([
            'user_id' => $userId
        ]);
        $rows = $stmt->fetchAll();
        $books = [];
        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->pdo->prepare('SELECT * FROM books WHERE id = :id');
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

    public function create(Book $book) : int{
        $stmt = $this->pdo->prepare('INSERT INTO books (title, author, description, image, availability, user_id) VALUES (:title, :author, :description, :image, :availability, :user_id)');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'availability' => $book->getAvailability(),
            'user_id' => $book->getUserId()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(Book $book) : void{
        $stmt = $this->pdo->prepare('UPDATE books SET title = :title, author = :author, description = :description, image = :image, availability = :availability WHERE id = :id');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'availability' => $book->getAvailability(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : void{
        $stmt = $this->pdo->prepare('DELETE FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);
    }
}