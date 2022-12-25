<?php
//OBETENER LOS DATOS DE LA BASE DE DATOS
$query = "SELECT * FROM raketi";
$resultadoConsulta = mysqli_query($db, $query);
?>
<div id="raketi">
    <h1>Ракети</h1>

    <section class="product_list ">
        <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
            <a href="/descripcion_producto.php?id=<?php echo $propiedad['id']; ?>&type=raketi">
            <article class="product">
                <div class="recuadro_imagen">
                    <img src="/build/img/imagenes/<?php echo $propiedad['image'] ?>" alt="">
                </div>
                <h2><?php echo $propiedad['name'] ?> </h2>
                <p><?php echo $propiedad['price'] ?> лв</p>
            
              
            </article>
        </a>
        <?php endwhile; ?>
    </section>
</div>