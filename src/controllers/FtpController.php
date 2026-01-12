<?php
require_once SRC_DIR . '/models/FtpModel.php';

function ftpPage() {
    $conn = getFtpConnection();
    if (!$conn) { die("Echec connexion FTP."); }

    // Gestion du dossier courant
    $currentDir = $_GET['dir'] ?? '.';
    if ($currentDir == '') $currentDir = '.';

    // Actions
    if (isset($_GET['sub'])) {
        $file = $_GET['file'] ?? '';

        switch ($_GET['sub']) {
            case 'upload':
                if (isset($_FILES['file_upload'])) {
                    $remotePath = $currentDir . '/' . $_FILES['file_upload']['name'];
                    uploadFile($conn, $_FILES['file_upload']['tmp_name'], $remotePath);
                }
                break;
            case 'download':
                // On télécharge dans un fichier temporaire puis on l'envoie au navigateur
                $tempFile = tempnam(sys_get_temp_dir(), 'ftp');
                if (downloadFile($conn, $file, $tempFile)) {
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="'.basename($file).'"');
                    readfile($tempFile);
                    unlink($tempFile);
                    exit;
                }
                break;
            case 'delete':
                deleteFile($conn, $file);
                break;
            case 'mkdir':
                if (!empty($_POST['dirname'])) makeDir($conn, $currentDir . '/' . $_POST['dirname']);
                break;
            case 'rmdir':
                removeDir($conn, $file);
                break;
            case 'chmod':
                if (isset($_POST['mode'])) changeMode($conn, octdec($_POST['mode']), $file);
                break;
        }
    }

    $files = getFileList($conn, $currentDir);
    require SRC_DIR . '/views/ftp_view.php';
    ftp_close($conn);
}