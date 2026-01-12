<?php
require_once SRC_DIR . '/models/ClientModel.php';

function clientPage() {
    $model = new ClientModel();
    $sub = $_GET['sub'] ?? 'list';

    // Traitement des formulaires (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($sub === 'add') {
            $model->create($_POST['nom'], $_POST['email']);
        } elseif ($sub === 'edit' && isset($_POST['id'])) {
            $model->update($_POST['id'], $_POST['nom'], $_POST['email']);
        }
        // Redirection après action pour éviter renvoi du formulaire
        header('Location: index.php?action=client');
        exit;
    }

    // Actions GET (Suppression, Affichage)
    if ($sub === 'delete' && isset($_GET['id'])) {
        $model->delete($_GET['id']);
        header('Location: index.php?action=client');
        exit;
    }

    // Préparation des données pour la vue
    $clients = $model->getAll();
    $clientToEdit = null;

    if ($sub === 'editForm' && isset($_GET['id'])) {
        $clientToEdit = $model->getById($_GET['id']);
    }

    require SRC_DIR . '/views/client_view.php';
}