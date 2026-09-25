<?php

class UserManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function create(User $user) : bool{
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)");
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(), 
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar()
        ]);
    }

    public function findByEmail(string $email) : ?User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([
            'email' => $email
        ]);
        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setAvatar($row['avatar']);
        $user->setCreatedAt(new DateTime($row['created_at']));

        return $user;
    }

    public function findByUsername(string $username) : ?User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([
            'username' => $username
        ]);
        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setAvatar($row['avatar']);
        $user->setCreatedAt(new DateTime($row['created_at']));

        return $user;
    }

    public function findById(int $id) : ?User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User();
        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setAvatar($row['avatar']);
        $user->setCreatedAt(new DateTime($row['created_at']));

        return $user;
    }

    public function update(User $user) : bool{
        $stmt = $this->db->prepare('UPDATE users SET username = :username, email = :email, password = :password, avatar = :avatar WHERE id = :id');
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar(),
            'id' => $user->getId()
        ]);
    }
}