<?php
//COMPROVAMOS SI EL USUARIO ESTA AUTENTICADO
session_start();
$auth = $_SESSION['login'];
if(!$auth){
    header('Location: /');
}


require '../includes/config/database.php';
$db = conectarDB();


$type = 'parti';
//Escribir query
$query = "SELECT * FROM " . $type;
//Consultar la DB
$resultadoConsulta = mysqli_query($db, $query);
//Mostrar mensaje condicional
$resultado = $_GET['resultado'] ?? null;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {   // PARA BORRAR LAS FOTOS
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {

        //Elimina el archivo
        $query = "SELECT image FROM " . $type . " WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('imagenes/' . $propiedad['image']);

        //Elimina la propiedad
        $query = "DELETE FROM " . $type . " WHERE id = ${id};";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
             header('location: /admin/propiedad_piratki.php');
        }
    }
}

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

        <a href="/admin/propiedades/crear.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="52" height="52" viewBox="0 0 24 24" stroke-width="2" stroke="#009988" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                <line x1="12" y1="11" x2="12" y2="17" />
                <line x1="9" y1="14" x2="15" y2="14" />
            </svg></a>
        <form method="POST" action="">
        <div class="nav_propiedades">
                
                <a href="/admin/propiedad_pirobaterii.php">Пиробатерии</a>
                <a href="/admin/propiedad_rimski.php">Римски свещи</a>
                <a href="/admin/propiedad_raketi.php">Ракети</a>
                <a href="/admin/propiedad_piratki.php">Пиратки</a>
                <a href="/admin/propiedad_dimki.php">Димки и Факли</a>
                <a href="/admin/propiedad_parti.php">Парти артикули</a>
                <a href="/admin/propiedad_scenichna.php">Сценична пиротехника</a>
            </div>
        </form>
        <?php foreach ($error as $err) : ?>
            <div class="alerta error">
                <?php echo $err; ?>
            </div>

        <?php endforeach; ?>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>Име</th>
                    <th>Сериен номер</th>
                    <th>Цена</th>
                    <th>Данни</th>
                    <th>Упътване</th>
                    <th>Категория</th>
                    <th>Снимка</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr class="contenido-tabla">
                        <td><?php echo $propiedad['name'] ?></td>
                        <td><?php echo $propiedad['number'] ?></td>
                        <td><?php echo $propiedad['price'] ?></td>
                        <td><?php echo $propiedad['description'] ?></td>
                        <td><?php echo $propiedad['description_use'] ?></td>
                        <td><?php echo $propiedad['kategory'] ?></td>
                        <td class="imagen-tabla"><img src="/admin/imagenes/<?php echo $propiedad['image'] ?>"></td>
                        <td class="botones">

                            <a class="boton-admin-actualizar" href="propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>&type=<?php echo $type?>">Актуализирай</a>

                            <form method="POST">
                                <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                                <input type="submit" class="boton-admin-borrar" value="Изтрий">
                            </form>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

</body>

</html>