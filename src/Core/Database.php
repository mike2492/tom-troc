<?php

// Singleton: one single PDO connection shared by the whole application.
class Database {

    private static ?PDO $instance = null;

    // Private constructor: prevents "new Database()" from outside.
    private function __construct(){}

    public static function getInstance() : PDO{
        if(self::$instance === null){
            try{
                // ERRMODE_EXCEPTION: SQL errors throw exceptions instead of failing silently.
                // FETCH_ASSOC: rows come back as associative arrays.
                self::$instance = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            }
            catch(PDOException $e){
                // Generic message: the real error could reveal credentials or paths.
                die('Erreur de connexion à la base de données');
            }
        }

        return self::$instance;
    }
}