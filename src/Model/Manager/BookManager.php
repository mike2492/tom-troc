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
}