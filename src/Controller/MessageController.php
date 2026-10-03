<?php

class MessageController extends Controller{

    public function index(){
        $this->requireAuth();
        $userId = (int) $_SESSION['user_id'];
        $messageManager = new MessageManager();
        $messages = $messageManager->findByUser($userId);

        $conversations = [];

        foreach($messages as $message){
            if($message->getSenderId() === $userId){
                $otherUserId = $message->getReceiverId();
            } else{ 
                $otherUserId = $message->getSenderId();
            }

            if(!isset($conversations[$otherUserId])){
                $conversations[$otherUserId] = $message;
            }
        }

        $userManager = new UserManager();
        $partners = [];

        foreach($conversations as $otherUserId => $message){
            $partners[$otherUserId] = $userManager->findById($otherUserId);
        }

        $selectedId = filter_var($_GET['user'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        $thread = [];
        $selected = null;

        if($selectedId !== null && $selectedId !== false){
            $selected = $userManager->findById($selectedId);
            if($selected !== null){
                $thread = $messageManager->findConversation($userId, $selectedId);
            }   
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && $selected !== null && $selectedId !== $userId){
            $content = trim($_POST['content'] ?? '');
            if($content !== ''){
                $newMessage = new Message([
                    'sender_id' => $userId,
                    'receiver_id' => $selectedId,
                    'content' => $content
                ]);       
                $messageManager->create($newMessage);
                header('Location: index.php?controller=message&action=index&user=' . $selectedId);
                exit;
            }
        }

        $this->render('message/index', ['conversations' => $conversations, 'partners' => $partners, 'thread' => $thread, 'selected' => $selected]);
    }
}