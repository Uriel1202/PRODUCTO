<?php
//session_start();
include "../Servidor/conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre_categoria'])) {
        $alert = '<div class="alert alert-primary" role="alert">
                    El campo de categoría es obligatorio.
                </div>';
    } else {
        $nombre_categoria = mysqli_real_escape_string($conexion, $_POST['nombre_categoria']);

        // Comprobar si la categoría ya existe
        $query = mysqli_query($conexion, "SELECT * FROM categorias WHERE categoria = '$nombre_categoria'");
        $result = mysqli_fetch_array($query);

        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                        La categoría ya existe!!!
                    </div>';
        } else {
            // Insertar nueva categoría
            $consulta = mysqli_query($conexion, "INSERT INTO categorias (categoria) VALUES('$nombre_categoria')");
            if ($consulta) {
                $alert = '<div class="alert alert-success" role="alert">
                       Categoría registrada!!!
                    </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                        Error al guardar la información: ' . mysqli_error($conexion) . '
                    </div>';
            }
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
  <title>Hello, world!</title>
</head>

<body>
  <header>
    <!--Encabezado-->
    <?php include_once("Vistas/encabezado.php"); ?>
  </header>
  <div class="container" style="text-align:center">
        <h2>Administración de Categorías</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Nueva Categoría
        </button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = mysqli_query($conexion, "SELECT * FROM categorias");
                while ($datos = mysqli_fetch_assoc($con)) {
                ?>
                <tr>
                    <td><?php echo $datos['idcat'] ?></td>
                    <td><?php echo $datos['categoria'] ?></td>
                    
                    <td><a href="../Servidor/editar categoria.php?id=<?php echo $datos['idcat']; ?>"><button type="button" class="btn btn-light"><i class="fi fi-rr-pencil"></i></button></a></td>
                    <td><a href="../Servidor/borrar categoria.php?id=<?php echo $datos['idcat']; ?>"><button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i></button></a></td>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Categorías</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div>
                            <?php echo isset($alert) ? $alert : ""; ?>
                        </div>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Categoría</span>
                            <input type="text" class="form-control" placeholder="Nombre de la categoría" name="nombre_categoria" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">
    <?php include_once("Vistas/pie.php"); ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</body>

</html>