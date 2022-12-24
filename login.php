<?php
require 'includes/config/database.php';
$db = conectarDB();



$errores = [];


//AUTENTICAR USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "Имейла е задължителен";
    }
    if (!$password) {
        $errores[] = "Паролата е задължителна";
    }

    if(empty($errores)){
        //Resvisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);
    
        if( $resultado->num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            
            $auth = password_verify($password, $usuario['password']);
            
            if($auth){
                //Contraseña correcta
                session_start();

                //Llenar el arreglo de la sesión
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('location: admin/index_propiedades.php');
            }else{
                $errores[]= "Невалидна парола";
            }

        }else{
            $errores[] = "Профила не съществува";
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
    <link rel="stylesheet" href="build/css/app.css" />
</head>

<body>
    <main class="contenedor ">
        <h3>Iniciar secion</h3>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta-error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;  ?>
        <form class="formularios-admin " method="POST">
            <fieldset>
                <legend>Вход </legend>

                <label for="email">Имейл</label>
                <input type="email" name="email" placeholder="Твоят имейл" id="email" >

                <label for="password">Парола</label>
                <input type="password" name="password" placeholder="Твоята парола" id="password">

            </fieldset>
            <input type="submit" value="Влизане" class="boton boton-admin-actualizar">
        </form>
    </main>

</body>

</html>