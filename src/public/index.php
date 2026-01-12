<?php
// Définition du chemin racine vers src
define('SRC_DIR', __DIR__ . '/..');

// Récupération de l'action
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'client':
        require_once SRC_DIR . '/controllers/ClientController.php';
        clientPage();
        break;

    case 'ftp':
        require_once SRC_DIR . '/controllers/FtpController.php';
        ftpPage();
        break;

    case 'mail':
        require_once SRC_DIR . '/controllers/MailController.php';
        mailPage();
        break;

    case 'shell':
        require_once SRC_DIR . '/controllers/SystemController.php';
        shellPage();
        break;

    default:
        echo "<h1>Menu TD7</h1>";
        echo "<ul>";
        echo "<li><a href='index.php?action=client'>Gestion des Clients (CRUD)</a></li>";
        echo "<li><a href='index.php?action=ftp'>Client FTP</a></li>";
        echo "<li><a href='index.php?action=mail'>Test Serveur Mail</a></li>";
        echo "<li><a href='index.php?action=shell'>Console Système</a></li>";
        echo "</ul>";
        break;
}