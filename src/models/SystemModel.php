<?php
function executeSystemCommand($command) {
    $output = [];
    $return_var = 0;

    // exécute la commande et récupère chaque ligne dans le tableau $output
    exec($command . ' 2>&1', $output, $return_var);

    return [
        'output' => $output,
        'status' => $return_var
    ];
}