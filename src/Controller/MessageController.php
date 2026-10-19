<?php

class MessageController extends Controller{
    
    public function index(){
        $this->requireLogin();
        $messageManager = new MessageManager();
        $messages = $messageManager->findByUserId($_SESSION['user_id']);

        $conversations = [];
        foreach($messages as $message){
            if($message->getSenderId() === $_SESSION['user_id']){
                $otherId = $message->getReceiverId();
            } else{
                $otherId = $message->getSenderId();
            }

            if(!isset($conversations[$otherId])){
                $conversations[$otherId] = $message;
            }
        }

        $this->render('message/index', ['title' => 'Messagerie', 'messages' => $messages, 'conversations' => $conversations]);
    }
}