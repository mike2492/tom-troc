<?php
class UserManager extends Manager{

    public function findByEmail(string $email) : ?User{

        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([
            'email' => $email
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        return new User($row);
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

        return new User($row);
    }

    public function create(User $user) : bool{
        $stmt = $this->db->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }
}