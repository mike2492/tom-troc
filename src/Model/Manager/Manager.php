<?php

// Base class of all managers: gives them the shared database connection.
// Managers are the only place where SQL is written.
abstract class Manager
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
