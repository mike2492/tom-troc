<?php
class MessageManager{

    private PDO $db;

    public function __construct(){
        $this->db = Database::getConnection();
    }

    public function create(Message $message) : void{
        $stmt = $this->db->prepare('INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)');
        $stmt->execute([
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
            'content' => $message->getContent()
        ]);
    }

    public function findConversationWith(int $userId, int $otherUserId) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE (sender_id = :userId AND receiver_id = :otherUserId) OR (sender_id = :otherUserId AND receiver_id = :userId) ORDER BY sent_at ASC');
        $stmt->execute([
            'userId' => $userId,
            'otherUserId' => $otherUserId
        ]);
        
        $rows = $stmt->fetchAll();
        $conversations = [];

        foreach($rows as $row){
            $message = new Message();
            $message->setId($row['id']);
            $message->setSenderId($row['sender_id']);
            $message->setReceiverId($row['receiver_id']);
            $message->setContent($row['content']);
            $message->setSentAt(new DateTime($row['sent_at']));
            $conversations[] = $message;
        }   

        return $conversations;
    }

    public function findConversations(int $userId) : array{
        $stmt = $this->db->prepare('SELECT * FROM messages WHERE sender_id = :userId OR receiver_id = :userId');
        $stmt->execute([
            'userId' => $userId
        ]);

        $rows = $stmt->fetchAll();
        $otherUserIds = [];
        foreach($rows as $row){
            if($row['sender_id'] == $userId){
                $otherId = $row['receiver_id'];
            } else{
                $otherId = $row['sender_id'];
            }

            if(!in_array($otherId, $otherUserIds)){
                $otherUserIds[] = $otherId;
            }
        }

        return $otherUserIds;
    }
}