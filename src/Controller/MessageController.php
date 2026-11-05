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

        $userManager = new UserManager();
        $contacts = [];
        foreach(array_keys($conversations) as $contactId){
            $contacts[$contactId] = $userManager->findById($contactId);
        }

        $id = (int) ($_GET['id'] ?? 0);
        $thread = [];
        $selected = null;
        $errors = [];

        if($id > 0){
            $user = $userManager->findById($id);
            if($user !== null && $user->getId() !== $_SESSION['user_id']){
                $selected = $user;
                if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    if(isset($_POST['content']) && is_string($_POST['content'])){
                        $content = trim($_POST['content']);

                        if($content === ''){
                            $errors['content'] = "Le message ne peut pas être vide";
                        } else{
                            $newMessage = new Message([
                                'sender_id' => $_SESSION['user_id'],
                                'receiver_id' => $id,
                                'content' => $content
                            ]);

                            $messageManager->create($newMessage);
                            header('Location: index.php?controller=message&action=index&id=' . $id);
                            exit;
                        }
                    } else {
                        $errors['form'] = "Formulaire invalide";
                    }
                }

                $thread = $messageManager->findConversation($_SESSION['user_id'], $id);
            }
        }


        $this->render('message/index', ['title' => 'Messagerie', 'messages' => $messages, 'conversations' => $conversations, 'contacts' => $contacts, 'thread' => $thread, 'selected' => $selected, 'errors' => $errors]);
    }
}