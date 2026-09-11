<?php
class MessageController extends Controller{

    public function inbox(){
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;           
        }

        $messageManager = new MessageManager();
        $userManager = new UserManager();

        $otherUserIds = $messageManager->findConversations($_SESSION['user_id']);
        $conversations = [];

        foreach($otherUserIds as $otherId){
            $conversations[] = $userManager->findById($otherId);
        }

        $this->render('message/inbox', ['conversations' => $conversations]);
    }

    public function thread(){
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;           
        }

        $otherId = (int) $_GET['id'];
        $userManager = new UserManager();
        $otherUser = $userManager->findById($otherId);

        if($otherUser === null){
            header('Location: index.php?controller=message&action=inbox');
            exit;
        }

        $messageManager = new MessageManager();
        $messages = $messageManager->findConversationWith($_SESSION['user_id'], 
        $otherId);

        $this->render('message/thread', ['otherUser' => $otherUser, 'messages' => $messages]);
    }

    public function send(){
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;           
        }

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $receiver_id = (int) $_POST['receiver_id'];
            $content = trim($_POST['content']);

            if(empty($content)){
                $errors['content'] = "Le contenu du message est vide";
            }

            if(empty($errors)){
                $message = new Message();
                $message->setSenderId($_SESSION['user_id']);
                $message->setReceiverId($receiver_id);
                $message->setContent($content);

                $messageManager = new MessageManager();
                $messageManager->create($message);
                
                header('Location: index.php?controller=message&action=thread&id=' . $receiver_id);
                exit;
            }
        }

        $this->render('message/thread', ['otherUser' => null, 'errors' => $errors]);
    }
}