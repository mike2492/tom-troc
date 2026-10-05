<?php

class MessageManager extends Manager{

    public function create(Message $message) : bool{
        $stmt = $this->db->prepare('INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)');
        return $stmt->execute([
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);
    }

    public function findThread(int $userA, int $userB) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE (sender_id = :a1 AND receiver_id = :b1) OR (sender_id = :b1 AND receiver_id = :a1) ORDER BY sent_at ASC, id ASC');
        $stmt->execute([
            'a1' => $userA,
            'b1' => $userB
        ]);

        $rows = $stmt->fetchAll();
        $threads = [];

        foreach($rows as $row){
            $threads[] = new Message($row);
        }

        return $threads;
    }

    public function findConversations(int $user_id) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE sender_id = :me OR receiver_id = :me ORDER BY sent_at DESC, id DESC');
        $stmt->execute([
            'me' => $user_id
        ]);
        
        $rows = $stmt->fetchAll();
        $conversations = [];

        foreach($rows as $row){
            $conversations[] = new Message($row);
        }

        return $conversations;
    }
}