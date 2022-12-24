<?php
//COMPROVAMOS SI EL USUARIO ESTA AUTENTICADO

session_start();
$auth = $_SESSION['login'];
if (!$auth) {
    header('Location: /');
}

var_dump($auth);
require '../includes/config/database.php';
$db = conectarDB();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../build/css/app.css" />
</head>

<body>
    <main class="contenedor">
        <h1>Създадени продукти</h1>
        <?php if ($auth) : ?>
                <a href="/cerrar-sesion.php">Cerrar Sesión</a>
            <?php endif; ?>

        <a href="/admin/propiedades/crear.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="52" height="52" viewBox="0 0 24 24" stroke-width="2" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <line x1="12" y1="11" x2="12" y2="17" />
                <line x1="9" y1="14" x2="15" y2="14" />
            </svg></a>

        <div class="nav_propiedades">

            <a href="/admin/propiedad_pirobaterii.php">Пиробатерии</a>
            <a href="/admin/propiedad_rimski.php">Римски свещи</a>
            <a href="/admin/propiedad_raketi.php">Ракети</a>
            <a href="/admin/propiedad_piratki.php">Пиратки</a>
            <a href="/admin/propiedad_dimki.php">Димки и Факли</a>
            <a href="/admin/propiedad_parti.php">Парти артикули</a>
            <a href="/admin/propiedad_scenichna.php">Сценична пиротехника</a>
        </div>
    </main>

</body>

</html>