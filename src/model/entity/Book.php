<?php

class Book extends Entity{

    private ?int $id = null;
    private string $title;
    private string $author;
    private string $description;
    private ?string $image = null;
    private string $status;
    private int $userId;
    private string $createdAt;

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }   
}