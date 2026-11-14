<?php

// Database access for the messages table (prepared queries only).
class MessageManager extends Manager{

    public function create(Message $message) : void{
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)");
        $stmt->execute([
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);
    }

    // All messages between two members, in both directions, oldest first.
    // Each placeholder has its own name (user_id1, user_id2...) because
    // the same name cannot be reused in one query with native prepared statements.
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

    // Every message sent or received by a member, newest first.
    // The controller uses it to build the list of conversations.
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