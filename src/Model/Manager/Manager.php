<?php

abstract class Manager{
    
    protected PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance();
    }
}