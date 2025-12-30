<?php
require_once 'models/SystemModel.php';

function shellPage() {
    $result = null;

    if (isset($_POST['command']) && !empty($_POST['command'])) {
        $result = executeSystemCommand($_POST['command']);
    }

    require 'views/shell_view.php';
}