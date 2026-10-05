<?php

class ProfileController extends Controller{

    public function show(){
        $this->requireAuth();

        $id = (int) ($_GET['id'] ?? 0);

        $userManager = new UserManager();
        $profileUser = $userManager->findById($id);

        if($profileUser === null || $id === $_SESSION['user_id']){
            header('Location: index.php?controller=account&action=index');
            exit;
        }

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $this->render('profile/show', ['title' => 'Profil', 'profileUser' => $profileUser, 'books' => $books]);
    }
}