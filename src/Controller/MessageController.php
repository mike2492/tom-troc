<?php

class MessageController extends Controller{

    public function thread(){
        $this->requireAuth();

        $otherId = (int) ($_GET['user'] ?? 0);
        $userManager = new UserManager();

        $otherUser = $userManager->findById($otherId);
        if($otherUser === null || $otherId === $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $errors = [];
        $messageManager = new MessageManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $content = trim($_POST['content'] ?? '');

            if(empty($content)){
                $errors['content'] = "Message requis";
            }

            if(empty($errors)){
                $message = new Message();
                $message->setSenderId($_SESSION['user_id']);
                $message->setReceiverId($otherId);
                $message->setContent($content);
                $messageManager->create($message);
                header('Location: index.php?controller=message&action=thread&user=' . $otherId);
                exit;
            }
        }

        
        $messages = $messageManager->findThread($_SESSION['user_id'], $otherId);
        [$conversations, $users] = $this->getConversations();



        $this->render('message/thread', ['title' => 'Messagerie', 
        'otherUser' => $otherUser, 'messages' => $messages, 'errors' => $errors, 'conversations' => $conversations, 'users' => $users]);
    }

    public function index(){
        $this->requireAuth();
        
        [$conversations, $users] = $this->getConversations();

        if(empty($conversations)){
            $otherUser = null;
            $messages = [];
        } else{
            $otherId = array_key_first($conversations);
            $otherUser = $users[$otherId];
            $messages = (new MessageManager())->findThread($_SESSION['user_id'], $otherId);
        }

        $this->render('message/thread', ['title' => 'Messagerie', 'conversations' => $conversations, 'users' => $users, 'errors' => [], 'otherUser' => $otherUser, 'messages' => $messages]); 
    }

    private function getConversations(){
        $messageManager = new MessageManager();

        $messages = $messageManager->findConversations($_SESSION['user_id']);
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

        $userManager = new UserManager();
        $users = [];

        foreach($conversations as $otherId => $message){
            $users[$otherId] = $userManager->findById($otherId);
        }

        return [$conversations, $users];
    }
}