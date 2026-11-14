<?php

// Database access for the users table.
// Every query is prepared: values are sent separately from the SQL,
// which prevents SQL injection.
class UserManager extends Manager{

    // Returns null when no user has this email.
    public function findByEmail(string $email) : ?User{
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
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
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
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

    // The password received here is already hashed by the controller.
    public function create(User $user) : void{
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);
    }

    public function findById(int $id) : ?User{
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
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

    // Saves every editable field, including the avatar file name.
    public function update(User $user) : void{
        $stmt = $this->db->prepare("UPDATE users SET username = :username, email = :email, password = :password, avatar = :avatar WHERE id = :id");
        $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'id' => $user->getId(),
            'avatar' => $user->getAvatar()
        ]);
    }
}