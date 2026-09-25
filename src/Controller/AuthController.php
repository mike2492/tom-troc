<?php

class AuthController extends Controller{

    public function register(){

        $errors = [];
        $userManager = new UserManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if(empty($username)){
                $errors['username'] = "Pseudo obligatoire";
            } elseif($userManager->findByUsername($username)){
                $errors['username'] = "Pseudo déjà utilisé";
            }   

            if(empty($email)){
                $errors['email'] = "Email obligatoire";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email non valide";
            } elseif($userManager->findByEmail($email)){
                $errors['email'] = "Email déjà utilisé";
            }

            if(empty($password)){
                $errors['password'] = "Mot de passe obligatoire";
            }

            if(empty($errors)){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User();
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($hashedPassword);
                $userManager->create($user);
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
        }

        $this->render('auth/register', ['title' => 'Inscription', 'errors' => $errors]);

    }

    public function login(){

        $errors = [];
        $userManager = new UserManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if(empty($email)){
                $errors['email'] = "Email obligatoire";
            }

            if(empty($password)){
                $errors['password'] = "Mot de passe obligatoire";
            }   

            if(empty($errors)){
                $user = $userManager->findByEmail($email);

                if($user === null || !password_verify($password, $user->getPassword())){
                    $errors['login'] = "Identifiant incorrect";
                } else{
                    $_SESSION['user_id'] = $user->getId();
                    header('Location: index.php?controller=account&action=index');
                    exit;
                }
            }
        }

        $this->render('auth/login', ['title' => 'Connexion', 'errors' => $errors]);
    }
}