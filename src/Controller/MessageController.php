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

        $this->render('message/index', ['conversations' => $conversations, 'partners' => $partners]);
    }
}