<?php

class AccountController extends Controller{

    public function index(){

        $this->requireLogin();

        $userManager = new UserManager();
        $bookManager = new BookManager();

        $user = $userManager->findById($_SESSION['user_id']);
        $books = $bookManager->findByUserId($_SESSION['user_id']);

        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])){
            $file = $_FILES['avatar'];

            if($file['error'] !== UPLOAD_ERR_OK){
                $errors['avatar'] = "Erreur lors de l'envoi de l'image";
            } elseif($file['size'] > 2 * 1024 * 1024){
                $errors['avatar'] = "Image trop lourde (2 Mo maximum)";
            } else{
                $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
                $mime = mime_content_type($file['tmp_name']);

                if(!isset($allowed[$mime])){
                    $errors['avatar'] = "Format non autorisé (jpg, png, webp)";
                } else{
                    $newName = bin2hex(random_bytes(16)) . '.' . $allowed[$mime];
                    move_uploaded_file($file['tmp_name'], __DIR__ . '/../../public/uploads/avatars/' . $newName);

                    if($user->getAvatar() !== null){
                        $oldFile = __DIR__ . '/../../public/uploads/avatars/' . $user->getAvatar();

                        if(is_file($oldFile)){
                            unlink($oldFile);
                        }
                    }

                    $user->setAvatar($newName);
                    $userManager->update($user);
                    header('Location: index.php?controller=account&action=index');
                    exit;
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_FILES['avatar'])){
            
            if(isset($_POST['email'], $_POST['username'], $_POST['password']) && is_string($_POST['email']) && is_string($_POST['username']) && is_string($_POST['password'])){

                $email = trim($_POST['email']);
                $username = trim($_POST['username']);
                $password = $_POST['password'];

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
            } else{
                $errors['form'] = "Formulaire invalide";
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