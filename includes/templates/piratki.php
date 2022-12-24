<?php
//OBETENER LOS DATOS DE LA BASE DE DATOS
$query = "SELECT * FROM piratki";
$resultadoConsulta = mysqli_query($db, $query);
?>
<div id="piratki">
    <h1>Пиратки</h1>

    <section class="product_list ">
      
    <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
         <a href="/descripcion_producto.php?id=<?php echo $propiedad['id']; ?>&type=piratki"> 
            <article class="product">
                <img src="/admin/imagenes/<?php echo $propiedad['image'] ?>" alt="">
                <h2><?php echo $propiedad['name'] ?> </h2>
                <p><?php echo $propiedad['price'] ?> лв</p>
         
            </article>
            </a>
        <?php endwhile; ?>
    </section>
</div>