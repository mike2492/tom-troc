<?php

class MessageController extends Controller{
    
    public function index(){
        $this->requireLogin();
        $messageManager = new MessageManager();
        $messages = $messageManager->findByUserId($_SESSION['user_id']);
        $this->render('message/index', ['title' => 'Messagerie', 'messages' => $messages]);
    }
}