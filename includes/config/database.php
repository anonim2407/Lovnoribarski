<?php

function conectarDb(): mysqli
{
    $db = mysqli_connect('localhost', 'root', 'Kk.268268', 'foerverki');

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        exit;
    }
    return $db;
}
