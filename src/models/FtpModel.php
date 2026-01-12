<?php
function getFtpConnection() {
    // Config FTP (IP Serveur VM)
    $server = "127.0.0.1"; // Ou l'IP interne si différente
    $user = "server";
    $pass = "server";

    $conn = ftp_connect($server);
    if ($conn && ftp_login($conn, $user, $pass)) {
        ftp_pasv($conn, true);
        return $conn;
    }
    return false;
}

function getFileList($conn, $dir) {
    return ftp_nlist($conn, $dir);
}

function uploadFile($conn, $local, $remote) {
    return ftp_put($conn, $remote, $local, FTP_BINARY);
}

function downloadFile($conn, $remote, $local) {
    return ftp_get($conn, $local, $remote, FTP_BINARY);
}

function deleteFile($conn, $file) {
    return ftp_delete($conn, $file);
}

function makeDir($conn, $dir) {
    return ftp_mkdir($conn, $dir);
}

function removeDir($conn, $dir) {
    return ftp_rmdir($conn, $dir);
}

function changeMode($conn, $mode, $file) {
    return ftp_chmod($conn, $mode, $file);
}