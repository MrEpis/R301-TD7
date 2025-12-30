<?php

require_once "../config/Database.php";

class ClientModel
{
    private PDO $db;

    private function __construct(){
        $this->db = Database::getInstance();
    }

    public function dbFindUser($email){
        $query = $this->db->prepare("SELECT * FROM client WHERE email = :email");
        $query->execute(array(
            'email' => $email
        ));
        return $query->fetch();
    }

    public function dbCreateUser($email, $passwordHash, $name, $firstname): bool
    {
        $query = $this->db->prepare("INSERT INTO client (email, mot_de_passe, nom, prenom) VALUES (:email, :mot_de_passe, :nom, :prenom)");
        return $query->execute(array(
            'email' => $email,
            'mot_de_passe' => $passwordHash,
            'nom' => $name,
            'prenom' => $firstname
        ));
    }


}