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
}