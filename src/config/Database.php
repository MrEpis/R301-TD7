<?php
class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct(){
        // Paramètres de la VM
        $host = "localhost";
        $dbname = "td7_db";
        $user = "td7_user";
         // Le mot de passe défini lors de la config MariaDB

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de connexion BDD : " . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance->pdo;
    }
}