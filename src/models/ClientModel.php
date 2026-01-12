<?php
require_once SRC_DIR . '/config/Database.php';

class ClientModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM client")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($nom, $email) {
        $stmt = $this->db->prepare("INSERT INTO client (nom, email) VALUES (?, ?)");
        return $stmt->execute([$nom, $email]);
    }

    public function update($id, $nom, $email) {
        $stmt = $this->db->prepare("UPDATE client SET nom = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM client WHERE id = ?");
        return $stmt->execute([$id]);
    }
}