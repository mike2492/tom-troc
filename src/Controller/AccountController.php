<?php

class AccountController extends Controller{

    public function index(){
        $this->requireAuth();
        $userManager = new UserManager();
        $user = $userManager->findById($_SESSION['user_id']);
        $errors = [];

        if($user === null){
            $_SESSION = [];
            session_destroy();
            header('Location: index.php?controller=auth&action=login');
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if(empty($username)){
                $errors['username'] = "Pseudo requis";
            } elseif(mb_strlen($username) > 50){
                $errors['username'] = "Pseudo trop long";
            } else{
                $existingUser = $userManager->findByUsername($username);
                if($existingUser !== null && $existingUser->getId() !== $user->getId()){
                    $errors['username'] = "Pseudo déjà utilisé";
                }
            }

            if(empty($email)){
                $errors['email'] = "Email requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email non valide";
            } else{ 
                $existingEmail = $userManager->findByEmail($email);
                if($existingEmail !== null && $existingEmail->getId() !== $user->getId()){
                    $errors['email'] = "Email déjà utilisé";
                }
            }

            if(empty($errors)){
                $user->setUsername($username);
                $user->setEmail($email);
                if($password !== ''){
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                }

                $userManager->update($user);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
           
        }
        
        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user, 'errors' => $errors]);
    }
}