<?php

class BookController extends Controller{

    public function add(){
        $this->requireLogin();

        $this->render('book/form', ['title' => 'Ajouter un livre']);
    }
}