<?php
class UserController extends Controller{

    public function show(){
        $id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if($id === false || $id === null){
            header('Location: index.php');
            exit;
        }

        $userManager = new UserManager();
        $user = $userManager->findById($id);

        $bookManager = new BookManager();
        $books = $bookManager->findByUserId($id);

        $this->render('user/show', ['user' => $user, 'books' => $books]);
    }
}