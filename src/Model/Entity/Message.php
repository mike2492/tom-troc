<?php

class Message extends Entity{
    
    private ?int $id = null;
    private int $senderId;
    private int $receiverId;
    private string $content;
    private ?DateTime $sentAt = null;

    public function setId(?int $id) : void{
        $this->id = $id;
    }

    public function setSenderId(int $senderId) : void{
        $this->senderId = $senderId;
    }

    public function setReceiverId(int $receiverId) : void{
        $this->receiverId = $receiverId;
    }

    public function setContent(string $content) : void{
        $this->content = $content;
    }

    public function setSentAt(string $sentAt) : void{
        $this->sentAt = new DateTime($sentAt);
    }

    public function getId() : ?int{
        return $this->id;
    }

    public function getSenderId() : int{
        return $this->senderId;
    }

    public function getReceiverId() : int{
        return $this->receiverId;
    }

    public function getContent() : string{
        return $this->content;
    }

    public function getSentAt() : ?DateTime{
        return $this->sentAt;
    }
}