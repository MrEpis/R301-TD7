<?php
require_once 'models/FtpModel.php';

function ftpPage() {
    // Tentative de connexion au serveur via le modèle
    $conn = getFtpConnection();

    if (!$conn) {
        $error = "Impossible de se connecter au serveur FTP.";
        require 'views/error.php';
        return;
    }

    // Gestion des actions spécifiques envoyées en paramètre URL
    if (isset($_GET['sub'])) {
        switch ($_GET['sub']) {
            case 'upload':
                if (isset($_FILES['file_upload'])) {
                    $local = $_FILES['file_upload']['tmp_name'];
                    $remote = $_FILES['file_upload']['name'];
                    uploadFile($conn, $local, $remote);
                }
                break;

            case 'delete':
                if (isset($_GET['file'])) {
                    ftp_delete($conn, $_GET['file']);
                }
                break;

            case 'chmod':
                if (isset($_GET['file']) && isset($_POST['mode'])) {
                    // Conversion de la chaîne octale en entier
                    ftp_chmod($conn, octdec($_POST['mode']), $_GET['file']);
                }
                break;
        }
    }

    // Récupération de la liste finale des fichiers pour la vue
    $files = listFiles($conn);

    // Fermeture propre de la connexion
    ftp_close($conn);

    // Chargement de la page HTML
    require 'views/ftp_view.php';
}