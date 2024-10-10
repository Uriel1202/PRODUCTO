<?php
session_start();
if (!isset($_SESSION['tiempo'])) {
    $_SESSION['tiempo'] = time();
} else if (time() - $_SESSION['tiempo'] > 15) {
    session_destroy();
    /* Aquí redireccionas a la url especifica */
    header("Location:../index.php");
    die();
}
$_SESSION['tiempo'] = time(); // Si hay actividad seteamos el valor al tiempo actual
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="text-align: center; padding-top: 60px; background-color: #e7e9c4; font-family: 'Times New Roman', Times, serif; font-weight:800;">
        <div class="row">
            <div class="col-3">
                <img src="Recursos/Logo.png" height="120px" width="120px">
            </div>
            <div class="col" style="padding-top: 40px;">
                <div class="btn-group" role="group" aria-label="Basic example">

                    <?php
                    if ($_SESSION['rol'] == 1) {
                    ?>

                        <a href="inicio.php"> <button type="button" class="btn btn-primary">Inicio</button></a>
                        <a href="usuarios.php"> <button type="button" class="btn btn-primary">Usuarios</button></a>
                        <a href="categorias.php"> <button type="button" class="btn btn-primary">Categorias</button></a>
                        <a href="productos.php"> <button type="button" class="btn btn-primary">Productos</button></a>
                        <a href="promociones.php"> <button type="button" class="btn btn-primary">Promociones</button></a>
                        <a href="reportes.php"> <button type="button" class="btn btn-primary">Reportes</button></a>
                        <a href="salir.php"> <button type="button" class="btn btn-primary">Salir</button></a>

                    <?php
                    }
                    ?>

                    <?php
                    if ($_SESSION['rol'] == 2) {
                    ?>

                        <a href="inicio.php"> <button type="button" class="btn btn-primary">Inicio</button></a>
                        <a href="productos.php"> <button type="button" class="btn btn-primary">Productos</button></a>
                        <a href="promociones.php"> <button type="button" class="btn btn-primary">Promociones</button></a>
                        <a href="salir.php"> <button type="button" class="btn btn-primary">Salir</button></a>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <!--
    Tarea:
        Cerrar sesion cuando tenga 3 min de ineactividad
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>