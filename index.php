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
        <a href="https://www.facebook.com/aresprovadia"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
            </svg></a>


    </nav>
    <header id="nachalo">
        <div class="fondo-header">
            <?php
            include 'includes/header.php'
            ?>

        </div>
    </header>
    <main class="contenedor items">
        <div class="items_horizontal">
            <a href="/apartado_baterii.php" class="item item1">
                <p>Пиробатерии</p>
                <p class="botones">Виж тук</p>
            </a>
            <a href="/apartado_rimski.php" class="item item2">
                <p>Римски свещи</p>
                <p class="botones">Виж тук</p>
            </a>
        </div>
        <a href="/apartado_raketi.php" class="item item3">
            <p>Ракети</p>
            <p class="botones">Виж тук</p>
        </a>
    </main>

    <?php
    include 'includes/footer.php'
    ?>

    <script src="/src/js/app.js"></script>

</body>

</html>