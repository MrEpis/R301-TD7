<?php
// Correction du chemin pour le modèle
require_once SRC_DIR . '/models/SystemModel.php';

function shellPage() {
    $result = null;

    if (isset($_POST['command']) && !empty($_POST['command'])) {
        $result = executeSystemCommand($_POST['command']);
    }

    // Correction du chemin pour la vue
    require SRC_DIR . '/views/shell_view.php';
}