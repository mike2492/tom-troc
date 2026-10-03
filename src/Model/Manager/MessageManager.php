<?php

class MessageManager extends Manager{

    public function create(Message $message) : int{
        $stmt = $this->pdo->prepare('INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)');
        $stmt->execute([
            'sender_id' => $message->getSenderId() ,
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}