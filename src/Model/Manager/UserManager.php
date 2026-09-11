<?php 

class UserManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function findByEmail(string $email) : ?User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([
            'email' => $email
        ]);

        $data = $stmt->fetch();
        if(!$data){
            return null;
        }

        $user = new User();
        $user->setId($data['id']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setAvatar($data['avatar']);
        $user->setCreatedAt(new DateTime($data['created_at']));

        return $user;
    }

    public function create(User $user) : void{
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }

    public function findByUsername(string $username) : ?User{
        $stmt = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([
            'username' => $username
        ]);

        $data = $stmt->fetch();
        if(!$data){
            return null;
        }

        $user = new User();
        $user->setId($data['id']);
        $user->setUsername($data['username']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setAvatar($data['avatar']);
        $user->setCreatedAt(new DateTime($data['created_at']));

        return $user;
    }
}