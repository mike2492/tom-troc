<?php

// A member of the site. Properties are private: they are only
// reachable through the getters and setters below.
class User extends Entity{
    
    private ?int $id = null;
    private string $username;
    private string $email;
    // Always the hash, never the plain password.
    private string $password;
    // File name only (the folder is added in the views). Null = no avatar yet.
    private ?string $avatar = null;
    // Kept as a string: the views format the date when displaying it.
    private string $createdAt;

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}