<?php
//COMPROVAMOS SI EL USUARIO ESTA AUTENTICADO
session_start();
$auth = $_SESSION['login'];
if(!$auth){
    header('Location: /');
}

require '../../includes/config/database.php';
$db = conectarDb();


$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('location: index_propiedades');
}
$type = $_GET['type'];


$consulta = "SELECT * FROM " . $type . " WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);




//Arreglo de errores
$error = [];


$name = $propiedad['name'];
$number = $propiedad['number'];
$price = $propiedad['price'];
$description = $propiedad['description'];
$description_use = $propiedad['description_use'];
$kategory = $propiedad['kategory'];
$imagenPropiedad = $propiedad['image'];


//Guarda los que has escrito en caso de que algo sean incorrecto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // exit;

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $description_use = mysqli_real_escape_string($db, $_POST['description_use']);
    $kategory = mysqli_real_escape_string($db, $_POST['kategory']);
    $image = $_FILES['image'] ?? null;



    //Mensajes de error Errores
    if ($select === '0') {
        $error[] = "Моля изберете ТИПА на продукта";
    }
    if (!$name) {
        $error[] = "Моля добавете ИМЕ на продукта";
    }
    if (!$number) {
        $error[] = "Моля добавете СЕРИЕН НОМЕР на продукта";
    }
    if (!$price) {
        $error[] = "Моля добавете ЦЕНА на продукта";
    }
    if (!$description) {
        $error[] = "Моля добавете ДАННИТЕ на продукта";
    }
    if (!$description_use) {
        $error[] = "Моля добавете УПЪТВАНЕ на продукта";
    }
    if (!$kategory) {
        $error[] = "Моля добавете КАТЕГОРИЯ на продукта";
    }
    $max = 3000 * 3000;
    if ($image['size'] > $max) {
        $error[] = "Снимката е много голяма";
    }


    // echo "<pre>";
    // var_dump($error);
    // echo "</pre>";

    if (empty($error)) {

        //CREAMOS LA CARPETA PARA LAS IMAGENES
        $carpetaImagenes = '../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
            //comprovamos si existe para no duplicarla
        }


        if ($image['name']) {
            unlink($carpetaImagenes . $propiedad['image']);

            //GENERAMOS NOMBRE UNICO DE LA IMAGEN
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            move_uploaded_file($image['tmp_name'], $carpetaImagenes . $nombreImagen);

            //Insertar en la base de datos
            $imagenPropiedad = $nombreImagen;

        }
        $query = "UPDATE ${type} SET name='${name}',number='${number}',price=${price},
        description='${description}',description_use='${description_use}',kategory='${kategory}', 
        image = '${imagenPropiedad}'  WHERE id= ${id}";


        $resultado = mysqli_query($db, $query);
    }
    if ($result) {
        header('location: /admin/');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <title>Document</title>
</head>

<body>
    <nav class="nav_secundary">
        <a href="#">Начало</a>
        <a href="#">За нас</a>
        <a href="#">Контакти</a>
    </nav>

    <main class="contenedor">
        <h1>Актуализиране на продукт</h1>

        <a href="/admin/index_propiedades.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009987" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <circle cx="12" cy="7" r="4" />
                <circle cx="6.5" cy="17" r="4" />
                <circle cx="17.5" cy="17" r="4" />
            </svg></a>

        <?php foreach ($error as $err) : ?>
            <div class="alerta error">
                <?php echo $err; ?>
            </div>
        <?php endforeach; ?>

        <section class="creat">
            <div class="form">
                <form method="POST" enctype="multipart/form-data">

                    <select name="mi_select" value="pirobaterii">
                        <option value="pirobaterii" selected>Пиробатерии</option>
                        <option value="rimski">Римски свещу</option>
                        <option value="raketi">Ракети</option>
                        <option value="piratki">Пиратки</option>
                        <option value="dimki">Димки и Факли</option>
                        <option value="parti">Парти артикули</option>
                        <option value="scenichna">Сценична пиротехника</option>
                    </select>

                    <label for="name">Име</label>
                    <input id="name" type="text" name="name" value="<?php echo $name; ?>">

                    <label for="number">Сериен номер</label>
                    <input id="number" name="number" type="text" value="<?php echo $number; ?>">

                    <label for="price">Цена</label>
                    <input id="price" name="price" type="number" step="any" value="<?php echo $price; ?>">

                    <label for="description">Данни</label>
                    <input id="description" name="description" type="text" value="<?php echo $description; ?>">

                    <label for="description_use">Упътване</label>
                    <textarea id="description_use" name="description_use" type="text" rows="20"> <?php echo $description_use; ?></textarea>

                    <label for="kategory">Категория</label>
                    <input id="kategory" name="kategory" type="text" value="<?php echo $kategory; ?>">

                    <label for="image">Снимка</label>
                    <input id="image" name="image" type="file" accept="image/jpeg, image/png, image/webp">

                    <img class="imagen_small" src="/admin/imagenes/<?php echo $imagenPropiedad; ?>" alt="Imagen Actual">

                    <input name="crear" type="submit" class="boton" value="Актуализиране на продукт">
                </form>
            </div>
        </section>
    </main>


</body>

</html>