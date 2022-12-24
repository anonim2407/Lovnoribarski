<?php
//COMPROVAMOS SI EL USUARIO ESTA AUTENTICADO
session_start();
$auth = $_SESSION['login'];
if(!$auth){
    header('Location: /');
}

require '../../includes/config/database.php';
$db = conectarDb();


$consulta = "SELECT * FROM " . 'raketi';
$resultado = mysqli_query($db, $consulta);




//Arreglo de errores
$error = [];

$select = null;
$name = '';
$number = '????';
$price = '';    
$description = '
2бр / 1 кутия
';
$description_use = '';
$kategory = 'F';


//Guarda los que has escrito en caso de que algo sean incorrecto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $description_use = mysqli_real_escape_string($db, $_POST['description_use']);
    $kategory = mysqli_real_escape_string($db, $_POST['kategory']);
    $image = $_FILES['image'];



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
    if (!$image['name'] || $image['error']) {
        $error[] = "Трябва да качите СНИМКА на продукта";
    }
    $max = 3000 * 3000;
    if ($image['size'] > $max) {
        $error[] = "Снимката е много голяма";
    }


    // echo "<pre>";
    // var_dump($error);
    // echo "</pre>";

    echo $_POST['mi_select'];
    if (empty($error)) {

        //CREAMOS LA CARPETA PARA LAS IMAGENES
        $carpetaImagenes = '../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
            //comprovamos si existe para no duplicarla
        }


        //GENERAMOS NOMBRE UNICO DE LA IMAGEN
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


        //SUBIMOS LA IMAGEN
        move_uploaded_file($image['tmp_name'], $carpetaImagenes .  $nombreImagen);


        $query = "INSERT INTO " . $_POST['mi_select'] . " (name, number, price, description, description_use,
         kategory, image ) 
         VALUES ( '$name', '$number', $price, '$description',  '$description_use', '$kategory', '$nombreImagen')";

        echo $query;

        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        if ($result) {
            header('location: /admin/propiedades/crear.php');
        }
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
        <h1>Създаване на продукти</h1>

        <a href="/admin/index_propiedades.php"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circles" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009987" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
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
                <form method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">

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

                    <input name="crear" type="submit" class="boton" value="Създаване на продукт">
                </form>
            </div>
        </section>
    </main>


</body>

</html>