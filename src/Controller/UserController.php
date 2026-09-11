<?php

class UserController extends Controller{

    public function account(): void{
        if(!$this->isLoggedIn()){
            header('Location: index.php?controller=auth&action=login');
            exit;
        }
        
        $userManager = new UserManager();
        $user = $userManager->findById($_SESSION['user_id']);
        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($_SESSION['user_id']);
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if(empty($username)){
                $errors['username'] = "Le pseudo est requis";
            }

            if(empty($email)){
                $errors['email'] = "L'email est requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "L'email est non valide";
            }

            if(empty($errors)){
                $user->setUsername($username);
                $user->setEmail($email);

                if(!empty($password)){
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $user->setPassword($hashedPassword);
                    $userManager->update($user, true);
                } else{
                    $userManager->update($user, false);
                }

                header('Location: index.php?controller=user&action=account');
                exit;
            }
        }

        $this->render('user/account', ['user' => $user, 'errors' => $errors, 'books' => $books]);
    }

    public function publicProfile(){
        
        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        
        $user = $userManager->findById($id);

        if($user === null){
            header('Location: index.php?controller=book&action=list');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $this->render('user/public', ['user' => $user, 'books' => $books]);
    }
}