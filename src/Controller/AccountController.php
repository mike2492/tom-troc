<?php

class AccountController extends Controller{

    public function index(){

        $this->requireLogin();

        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = trim($_POST['email'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $existingEmail = $userManager->findByEmail($email);
            $existingUsername = $userManager->findByUsername($username);

            if($email === ''){
                $errors['email'] = "Email requis";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email non valide";
            } elseif($existingEmail !== null && $existingEmail->getId() !== $user->getId()){
                $errors['email'] = "Email déjà pris";
            }

            if($username === ''){
                $errors['username'] = "Pseudo requis";
            } elseif($existingUsername !== null && $existingUsername->getId() !== $user->getId()){
                $errors['username'] = "Pseudo déjà pris";
            }

            if(empty($errors)){
                $user->setEmail($email);
                $user->setUsername($username);
                if($password !== ''){
                    $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
                }

                $userManager->update($user);
                header('Location: index.php?controller=account&action=index');
                exit;
            }
      }

        $this->render('account/index', ['title' => 'Mon compte', 'user' => $user, 'books' => $books, 'errors' => $errors]);
    }

    public function show(){
        $id = (int) ($_GET['id'] ?? 0);
        $userManager = new UserManager();

        $user = $userManager->findById($id);
        if($user === null){
            header('Location: index.php?controller=book&action=index');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $this->render('account/show', ['title' => $user->getUsername(), 'user' => $user, 'books' => $books]);
    }
}