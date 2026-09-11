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

    public function findByUserId(int $userId) : array{
        $stmt = $this->db->prepare('SELECT * FROM books WHERE user_id = :userId');
        $stmt->execute([
            'userId' => $userId
        ]);

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

   public function create(Book $book) : void{
        $stmt = $this->db->prepare('INSERT INTO books (title, author, description, image, available, user_id) VALUES (:title, :author, :description, :image, :available, :user_id)');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'available' => $book->getAvailable(),
            'user_id' => $book->getUserId()
        ]);
    }

    public function update(Book $book) : void{
        $stmt = $this->db->prepare('UPDATE books SET title = :title, author = :author, description = :description, image = :image, available = :available WHERE id = :id');
        $stmt->execute([
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'description' => $book->getDescription(),
            'image' => $book->getImage(),
            'available' => $book->getAvailable(),
            'id' => $book->getId()
        ]);
    }

    public function delete(int $id) : void{
        $stmt = $this->db->prepare('DELETE FROM books WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);
    }
}