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
}