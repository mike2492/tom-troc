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
                $errors['username'] = "Pseudo trop long (50 caractères max)";
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
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user = new User([
                    'username' => $username,
                    'email' => $email,
                    'password' => $hashedPassword
                ]);
                $userManager->create($user);
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
        }
        
        $this->render('auth/register', ['errors' => $errors]);
    }

    public function login(){
        $errors = [];
        $userManager = new UserManager();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if(empty($email)){
                $errors['email'] = "Email requis";
            }

            if(empty($password)){
                $errors['password'] = "Mot de passe requis";
            }

            if(empty($errors)){
                $user = $userManager->findByEmail($email);
                
                if($user === null || !password_verify($password, $user->getPassword())){
                    $errors['login'] = "Email ou mot de passe incorrect";
                } else{
                    $_SESSION['user_id'] = $user->getId();
                    header('Location: index.php');
                    exit;
                }
            }
        }

        $this->render('auth/login', ['errors' => $errors]);
    }
}