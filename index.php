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
        <a href="/">Начало</a>
        <a href="#">За нас</a>
        <a href="#">Контакти</a>
        
    </nav>
    <header>
        <?php
        include 'includes/header.php'
        ?>
        <?php
        include 'includes/slider.php'
        ?>
    </header>
    <main class="contenedor2">
        <?php
        include 'includes/templates/baterii.php';
        include 'includes/templates/rimski.php';
        include 'includes/templates/raketi.php';
        ?>

        <?php
        include 'includes/templates/piratki.php'
        ?>
        <?php
        include 'includes/templates/dimki.php'
        ?>
        <?php
        include 'includes/templates/parti.php'
        ?>
        <?php
        include 'includes/templates/scenichna.php'
        ?>
    </main>

    <?php
        include 'includes/footer.php'
        ?>

    <script src="/src/js/app.js"></script>

</body>

</html>