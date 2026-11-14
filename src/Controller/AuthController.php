<?php

// Handles registration, login and logout.
class AuthController extends Controller{

    public function register(){

        $errors = [];
        $userManager = new UserManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // Fields must exist and be plain strings (an array like username[]=x would crash trim()).
            if(isset($_POST['username'], $_POST['email'], $_POST['password']) && is_string($_POST['username']) && is_string($_POST['email']) && is_string($_POST['password'])){

                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];

                if($username === ''){
                    $errors['username'] = "Pseudo requis";
                } elseif($userManager->findByUsername($username)){
                    $errors['username'] = "Pseudo déjà pris";
                }
                
                if($email === ''){
                    $errors['email'] = "Email requis";
                } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "Email non valide";
                } elseif($userManager->findByEmail($email)){
                    $errors['email'] = "Email déjà pris";
                } 

                if($password === ''){
                    $errors['password'] = "Mot de passe requis";
                }

                if(empty($errors)){
                    // Never store a plain password: only its hash.
                    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                    $user = new User([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashPassword
                    ]);
                    $userManager->create($user);
                    // Redirect after POST so a page refresh does not resend the form.
                    header('Location: index.php?controller=auth&action=login');
                    exit;
                }
            } else{
                $errors['form'] = "Formulaire invalide";
            }      
        } 

        $this->render('auth/register', ['title' => 'Inscription', 'errors' => $errors]);
    }

    public function login(){
        
        $errors = [];
        $userManager = new UserManager();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(isset($_POST['email'], $_POST['password']) && is_string($_POST['email']) && is_string($_POST['password'])){

                $email = trim($_POST['email']);
                $password = $_POST['password'];

                if($email === ''){
                    $errors['email'] = "Email requis"; 
                } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "Email non valide";
                }

                if($password === ''){
                    $errors['password'] = "Mot de passe requis";
                }

                if(empty($errors)){
                    $user = $userManager->findByEmail($email);
                    // One single message for both cases: do not reveal which part is wrong.
                    if($user === null || !password_verify($password, $user->getPassword())){
                        $errors['login'] = "Email ou mot de passe incorrect";
                    } else{
                        // New session id after login: prevents session fixation.
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = $user->getId();
                        header('Location: index.php');
                        exit;
                    }
                }
            } else{
                $errors['form'] = "Formulaire invalide";
            }
        }

        $this->render('auth/login', ['title' => 'Connexion', 'errors' => $errors]);
    }

    public function logout(){
        // Empty the session data, then destroy the session itself.
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit;
    }
}