<?php
class BookManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function findAll(?string $search = null) : array{
         if (!empty($search)) {
            $stmt = $this->db->prepare('SELECT * FROM books WHERE title LIKE :search');
            $stmt->execute(['search' => '%' . $search . '%']);
        } else {
            $stmt = $this->db->prepare('SELECT * FROM books');
            $stmt->execute();
        }

        $rows = $stmt->fetchAll();
        $books = [];

        foreach ($rows as $data) {
            $book = new Book();
            $book->setId($data['id']);
            $book->setTitle($data['title']);
            $book->setAuthor($data['author']);
            $book->setDescription($data['description']);
            $book->setImage($data['image']);
            $book->setAvailable($data['available']);
            $book->setCreatedAt(new DateTime($data['created_at']));
            $book->setUserId($data['user_id']);
            $books[] = $book;
        }

        return $books;
    }

    public function findById(int $id) : ?Book{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $data = $stmt->fetch();

        if(!$data){
            return null;
        }
        
        $book = new Book();
        $book->setId($data['id']);
        $book->setTitle($data['title']);
        $book->setAuthor($data['author']);
        $book->setDescription($data['description']);
        $book->setImage($data['image']);
        $book->setAvailable($data['available']);
        $book->setCreatedAt(new DateTime($data['created_at']));
        $book->setUserId($data['user_id']);

        return $book;
        
    }
}