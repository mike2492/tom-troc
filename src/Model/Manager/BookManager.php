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
}