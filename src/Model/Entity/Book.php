<?php

class Book extends Entity{

    private ?int $id = null;
    private string $title;
    private string $author;
    private string $description;
    private ?string $image = null;
    private string $availability;
    private ?string $created_at = null;
    private int $user_id;

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

    public function setAvailability(string $availability) : void{
        $this->availability = $availability;
    }

    public function setCreatedAt(?string $created_at) : void{
        $this->created_at = $created_at;
    }

    public function setUserId(int $user_id) : void{
        $this->user_id = $user_id;
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

    public function getAvailability() : string{
        return $this->availability;
    }

    public function getCreatedAt() : ?string{
        return $this->created_at;
    }

    public function getUserId() : int{
        return $this->user_id;
    }
}