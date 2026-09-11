<?php


class Book
{
    private ?int $id = null;
    private string $title;
    private string $author;
    private string $description;
    private ?string $image = null;
    private string $available = 'available';
    private ?DateTime $createdAt = null;
    private int $userId;

    public function setId(?int $id) : void{
        $this->id = $id;        
    }

    public function setTitle(string $title) : void{
        $this->title = $title;
    }

    public function setAuthor(string $author) : void{
        $this->author = $author;
    }

    public function setDescription(string $description) : void{
        $this->description = $description;
    }   

    public function setImage(?string $image) : void{
        $this->image = $image;
    }

    public function setAvailable(string $available) : void{
        $this->available = $available;
    }

    public function setCreatedAt(?DateTime $createdAt) : void{
        $this->createdAt = $createdAt;
    }   

    public function setUserId(int $userId) : void{
        $this->userId = $userId;
    }

    public function getId() : ?int{
        return $this->id;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function getAuthor() : string{
        return $this->author;
    }

    public function getDescription() : string{
        return $this->description;
    }

    public function getImage() : ?string{
        return $this->image;
    }

    public function getAvailable() : string{
        return $this->available;
    }

    public function getCreatedAt() : ?DateTime{
        return $this->createdAt;
    }

    public function getUserId() : int{
        return $this->userId;
    }
}