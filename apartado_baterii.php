<?php

require 'includes/config/database.php';

$db = conectarDb();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>
    <nav class="nav_secundary">
        <a href="/index.php">Начало</a>
        <a href="#kontakt">За нас</a>
    </nav>
    <header>
        <?php
        include 'includes/header.php'
        ?>
        
        </div>
    </header>
    <main class="contenedor2">
        <?php
        include 'includes/templates/baterii.php';
        ?>
    </main>

    <?php
        include 'includes/footer.php'
        ?>

    <script src="/src/js/app.js"></script>

</body>

</html>