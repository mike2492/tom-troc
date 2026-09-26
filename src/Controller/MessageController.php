<?php

class MessageController extends Controller{
    
    public function index(){
        $this->requireAuth();
        $messageManager = new MessageManager();
        $userManager = new UserManager();
        $messages = $messageManager->findConversationsByUser($_SESSION['user_id']);

        $conversations = [];
        $otherUser = null;
        if(isset($_GET['with'])){
            $with = (int) $_GET['with'];
            $conversations = $messageManager->findConversation($_SESSION['user_id'], $with);
            $otherUser = $userManager->findById($with);
        }

        $this->render('message/index', ['title' => 'Messagerie', 'messages' => $messages, 'conversations' => $conversations, 'otherUser' => $otherUser]);
    }

    public function send(){
        $this->requireAuth();
        $messageManager = new MessageManager();
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $receiver_id = (int) $_POST['receiver_id'];
            $content = trim($_POST['content']);

            if(empty($content)){
                $errors['content'] = "Message obligatoire";
            }

            if(empty($errors)){
                $message = new Message();
                $message->setSenderId($_SESSION['user_id']);
                $message->setReceiverId($receiver_id);
                $message->setContent($content);
                $messageManager->create($message);
                header('Location: index.php?controller=message&action=index&with=' . $receiver_id);
                exit;
            }
        }
        
        header('Location: index.php?controller=message&action=index');
        exit;
    }
}