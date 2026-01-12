<?php
function mailPage() {
    $msg = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $headers = 'From: r301-td7@example.com' . "\r\n" .
            'Reply-To: r301-td7@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers)) {
            $msg = "Email envoyé avec succès !";
        } else {
            $msg = "Echec de l'envoi.";
        }
    }
    require SRC_DIR . '/views/mail_view.php';
}