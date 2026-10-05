<?php

abstract class Manager{

    protected PDO $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }
}