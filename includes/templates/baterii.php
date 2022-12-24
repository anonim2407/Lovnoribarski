<?php
//OBETENER LOS DATOS DE LA BASE DE DATOS
$query = "SELECT * FROM pirobaterii";
$resultadoConsulta = mysqli_query($db, $query);
?>
<div id="pirobaterii">
    <h1>Пиробатерии</h1>

    <section class="product_list ">
        <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <a class="hover_efect" href="/descripcion_producto.php?id=<?php echo $propiedad['id']; ?>&type=pirobaterii">
                <article class="product">
                    <div class="recuadro_imagen">
                        <img src="/admin/imagenes/<?php echo $propiedad['image'] ?>" alt="">
                    </div>
                    <h2><?php echo $propiedad['name'] ?> </h2>
                    <p><?php echo $propiedad['price'] ?> лв</p>
                </article>
            </a>
        <?php endwhile; ?>
    </section>
</div>