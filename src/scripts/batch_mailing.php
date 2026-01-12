<?php
// On doit inclure la config manuellement car on est hors du routeur index.php
require_once __DIR__ . '/../src/config/Database.php';

// Récupération des clients via PDO direct (ou via le modèle si on l'inclut)
$db = Database::getInstance();
$stmt = $db->query("SELECT email FROM client");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Début de l'envoi du mailing...\n";
$logFile = __DIR__ . '/mailing_log.txt';
$count = 0;

foreach ($clients as $client) {
    $to = $client['email'];
    $subject = "Newsletter Automatique";
    $message = "Bonjour, ceci est un message automatique.";

    // Envoi
    if(mail($to, $subject, $message)) {
        $status = "OK";
    } else {
        $status = "FAIL";
    }

    // Log
    $logLine = date('Y-m-d H:i:s') . " - Envoi à $to : $status\n";
    file_put_contents($logFile, $logLine, FILE_APPEND);
    echo $logLine;

    $count++;

    // Pause pour respecter la limite de 4 mails / seconde
    // 1 seconde = 1 000 000 microsecondes.
    // 1/4 seconde = 250 000 microsecondes.
    usleep(250000);
}

echo "Terminé. $count mails traités.\n";