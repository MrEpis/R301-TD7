<?php
function getFtpConnection() {
    $conn_id = ftp_connect("192.168.X.X"); // Remplace par l'IP de ta VM Serveur
    $login = ftp_login($conn_id, "ton_user", "ton_mdp");

    if (!$conn_id || !$login) return false;

    // Activation du mode passif pour passer les pare-feu
    ftp_pasv($conn_id, true);
    return $conn_id;
}

function listFiles($conn) {
    return ftp_nlist($conn, ".");
}

function uploadFile($conn, $local, $remote) {
    return ftp_put($conn, $remote, $local, FTP_BINARY);
}