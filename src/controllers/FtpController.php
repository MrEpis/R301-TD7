<?php
// On utilise SRC_DIR pour cibler le modèle correctement
require_once SRC_DIR . '/models/FtpModel.php';

function ftpPage() {
    $conn = getFtpConnection();

    if (!$conn) {
        $error = "Impossible de se connecter au serveur FTP.";
        // On peut créer une vue d'erreur générique ou juste faire un echo pour l'instant
        echo $error;
        return;
    }

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
                // Note : Assurez-vous que l'utilisateur a les droits de faire cela
                if (isset($_GET['file']) && isset($_POST['mode'])) {
                    ftp_chmod($conn, octdec($_POST['mode']), $_GET['file']);
                }
                break;
        }
    }

    $files = listFiles($conn);
    ftp_close($conn);

    // Correction du chemin pour la vue
    require SRC_DIR . '/views/ftp_view.php';
}