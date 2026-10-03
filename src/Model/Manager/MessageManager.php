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

    public function findConversation(int $userA, int $userB) : array{
        $stmt = $this->pdo->prepare('SELECT * FROM messages WHERE (sender_id = :a AND receiver_id = :b) OR (sender_id = :b AND receiver_id = :a) ORDER BY sent_at ASC');
        $stmt->execute([
            'a' => $userA,
            'b' => $userB
        ]);

        $rows = $stmt->fetchAll();
        $messages = [];
        foreach($rows as $row){
            $messages[] = new Message($row);
        }

        return $messages;
    }
}