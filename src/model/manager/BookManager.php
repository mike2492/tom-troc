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
}