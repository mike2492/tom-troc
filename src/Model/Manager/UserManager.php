<?php

class UserManager extends Manager{

    public function findByEmail(string $email) : ?User{
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([
            'email' => $email
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User($row);
        return $user;
    }

    public function findByUsername(string $username) : ?User{
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute([
            'username' => $username
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User($row);

        return $user;
    }

    public function findById(int $id) : ?User{
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch();

        if($row === false){
            return null;
        }

        $user = new User($row);
        return $user;
    }

    public function create(User $user) : int{
        $stmt = $this->pdo->prepare('INSERT INTO users (username, email, password, avatar) VALUES (:username, :email, :password, :avatar)');
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar()
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function update(User $user) : void{
        $stmt = $this->pdo->prepare('UPDATE users SET username = :username, email = :email, password = :password, avatar = :avatar WHERE id = :id');
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'avatar' => $user->getAvatar(),
            'id' => $user->getId()
        ]);
    }
}