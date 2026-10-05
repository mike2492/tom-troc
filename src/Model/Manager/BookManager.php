<?php

class BookManager extends Manager{

    public function findByUserId(int $user_id) : array{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE user_id = :user_id ORDER BY created_at DESC');
        $stmt->execute([
            'user_id' => $user_id
        ]);

        $rows = $stmt->fetchAll();
        $books = [];

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function create(Book $book) : bool{
        $stmt = $this->db->prepare('INSERT INTO books (title, author, description, availability, user_id) VALUES (:title, :author, :description, :availability, :user_id)');
        return $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'availability' => $book->getAvailability(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        return new Book($row);
    }

    public function update(Book $book) : bool{
        $stmt = $this->db->prepare('UPDATE books SET title = :title, author = :author, description = :description, availability = :availability WHERE id = :id');
        return $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'availability' => $book->getAvailability(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : bool{
        $stmt = $this->db->prepare('DELETE FROM books WHERE id = :id');
        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function findAll() : array{
        $stmt = $this->db->prepare('SELECT * FROM books ORDER BY created_at DESC');
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $books = [];

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }

    public function findByTitle(string $search) : array{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE title LIKE :search ORDER BY created_at DESC');
        $stmt->execute([
            'search' => '%' . $search . '%'
        ]);
        $rows = $stmt->fetchAll();
        $books = [];

        foreach($rows as $row){
            $books[] = new Book($row);
        }

        return $books;
    }
}