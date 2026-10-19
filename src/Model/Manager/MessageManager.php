<?php

class MessageManager extends Manager{

    public function create(Message $message) : void{
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)");
        $stmt->execute([
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);
    }

    public function findConversation(int $userId, int $otherId) : array{
        $stmt = $this->db->prepare("SELECT * FROM messages
        WHERE (sender_id = :user_id1 AND receiver_id = :other_id1)
        OR (sender_id = :other_id2 AND receiver_id = :user_id2)
        ORDER BY sent_at ASC");
        $stmt->execute([
            'user_id1' => $userId,
            'other_id1' => $otherId,
            'user_id2' => $userId,
            'other_id2' => $otherId
        ]);

        $messages = [];
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $messages[] = new Message($row);
        }

        return $messages;
    }

    public function findByUserId(int $userId) : array{
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE sender_id = :sender_id OR receiver_id = :receiver_id ORDER BY sent_at DESC");
        $stmt->execute([
            'sender_id' => $userId,
            'receiver_id' => $userId
        ]);

        $messages = [];
        $rows = $stmt->fetchAll();
        foreach($rows as $row){
            $messages[] = new Message($row);
        }

        return $messages;
    }
}