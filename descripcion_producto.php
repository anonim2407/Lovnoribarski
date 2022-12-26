<?php

require 'includes/config/database.php';

$db = conectarDb();
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
$type = $_GET['type'];


$query = "SELECT * FROM " . $type . " WHERE id = ${id}";
$resultadoConsulta = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultadoConsulta);
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

    <header>
        <?php
        include 'includes/header.php'
        ?>
    </header>
    <main>



        <section class=" contenedor">
            <article class="product_description">
                <div class="recuadro_imagen-des">
                    <img src="/build/img/imagenes/<?php echo $propiedad['image'] ?>" alt="">
                </div>
                <div>
                    <p class="name"><?php echo $propiedad['name'] ?> </p>
                    <p class="number">Nº: <?php echo $propiedad['number'] ?></p>
                    <p class="description"><?php echo $propiedad['description'] ?></p>
                    <p class="price"><?php echo $propiedad['price'] ?> лв</p>
                    <p class="description_use"><?php echo $propiedad['description_use'] ?></p>
                </div>
            </article>
        </section>

    </main>
    <script src="/src/js/app.js"></script>
<?php
    include 'includes/footer.php'
?>
</body>

</html>