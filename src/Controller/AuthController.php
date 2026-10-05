<?php

class AuthController extends Controller{

    public function register(){

        $errors = [];
        $userManager = new UserManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if(empty($username)){
                $errors['username'] = "Pseudo requis";
            } elseif(mb_strlen($username) > 50){
                $errors['username'] = "Pseudo trop long";
            } elseif($userManager->findByUsername($username)){
                $errors['username'] = "Pseudo déjà utilisé";
            }


            if(empty($email)){
                $errors['email'] = "Email requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email non valide";
            } elseif($userManager->findByEmail($email)){
                $errors['email'] = "Email déjà utilisé";
            }

            if(empty($password)){
                $errors['password'] = "Mot de passe requis";
            }

            if(empty($errors)){
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($hashPassword);
                $userManager->create($user);
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
        }

        $this->render('auth/register', ['title' => 'Inscription', 'errors' => $errors]);

    }
}