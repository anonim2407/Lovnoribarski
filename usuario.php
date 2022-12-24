<?php 

    // Consultar la propiedad
    require 'includes/config/database.php';
    $db = conectarDb();


    // Inserta un admin
    $email = "ares_ood@abv.bg";
    $password = "268268";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    // echo strlen($passwordHash);


    // echo $passwordHash;


    $query = "INSERT INTO usuarios (email, password) VALUES('${email}', '${passwordHash}') ";

    echo $query;

    mysqli_query($db, $query);


?>