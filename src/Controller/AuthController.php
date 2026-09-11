<?php

class AuthController extends Controller{

    public function register(){

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userManager = new UserManager();

            if(empty($username)){
                $errors['username'] = "Le pseudo est requis";
            } elseif($userManager->findByUsername($username) !== null){
                $errors['username'] = "Le pseudo est déja utilisé";
            }

            if(empty($email)){
                $errors['email'] = "L'email est requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "L'email est non valide";
            } elseif($userManager->findByEmail($email) !== null){
                $errors['email'] = "L'email est deja utilisé";
            }

            if(empty($password)){
                $errors['password'] = "Le mot de passe est requis";
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

        $this->render('auth/register',  ['errors' => $errors]);
    }

    public function login(){

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $userManager = new UserManager();

            if(empty($email)){
                $errors['email'] = "L'email est requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "L'email n'est pas valide";
            }   

            if(empty($password)){
                $errors['password'] = "Le mot de passe est requis";
            }

            if(empty($errors)){
                $user = $userManager->findByEmail($email);
                if($user === null || !password_verify($password, $user->getPassword())){
                    $errors['login'] = "Email ou mot de passe incorrect";
                }  else{
                    $_SESSION['user_id'] = $user->getId();
                    header('Location: index.php?controller=user&action=account');
                    exit;                   
                }      
            }
        }
        
        $this->render('auth/login', ['errors' => $errors]);
    }

    public function logout(){
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
    }
}