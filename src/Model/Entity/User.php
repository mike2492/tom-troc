<?php

class User extends Entity{

    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar = null;
    private ?string $created_at = null;

    public function setId(?int $id) : void{
        $this->id = $id;
    }

    public function setUsername(string $username) : void{
        $this->username = $username;
    }

    public function setEmail(string $email) : void{
        $this->email = $email;
    }

    public function setPassword(string $password) : void{
        $this->password = $password;
    }

    public function setAvatar(?string $avatar) : void{
        $this->avatar = $avatar;
    }

    public function setCreatedAt(?string $created_at) : void{
        $this->created_at = $created_at;
    }

    public function getId() : ?int{
        return $this->id;
    }

    public function getUsername() : string{
        return $this->username;
    }

    public function getEmail() : string{
        return $this->email;
    }

    public function getPassword() : string{
        return $this->password;
    }

    public function getAvatar() : ?string{
        return $this->avatar;
    }

    public function getCreatedAt() : ?string{
        return $this->created_at;
    }
}