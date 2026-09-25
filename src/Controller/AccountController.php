<?php

class AccountController extends Controller{

    public function index(){
        $this->requireAuth();

        $userManager = new UserManager();
        $bookManager = new BookManager();


        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user, 'books' => $books]);
    }

    public function show(){
        $id = (int) $_GET['id'];
        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($id);

        if($user === null){
            header('Location: index.php?controller=home&action=index');
            exit;
        }

        $books = $bookManager->findByUserId($id);

        $this->render('account/show', ['title' => $user->getUsername(), 'user' => $user, 'books' => $books]);
    }

    public function update(){
        $this->requireAuth();

        $errors = [];
        $userManager = new UserManager();
        $bookManager = new BookManager();
        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            
            
            if(!empty($username)){
                if($userManager->findByUsername($username) !== null && $username !== $user->getUsername()){
                    $errors['username'] = "Ce pseudo est déjà utilisé.";   
                } else{
                    $user->setUsername($username);
                }
            }

            if(!empty($email)){
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errors['email'] = "Email non valide";
                } elseif($userManager->findByEmail($email) !== null && $email !== $user->getEmail()){
                    $errors['email'] = "Cet email est déjà utilisé";
                } else{
                    $user->setEmail($email);
                }
            }

            if(!empty($password)){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $user->setPassword($hashedPassword);
            }

            if(empty($errors)){
                $userManager->update($user);
            }
        }

        $this->render('account/index', ['title' => 'Mon compte', 'errors' => $errors, 'user' => $user, 'books' => $books]);
    }
}