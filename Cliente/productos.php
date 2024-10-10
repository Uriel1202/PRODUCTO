<?php
//session_start();
include "../Servidor/conexion.php";

if (!empty($_POST)) {
  $alert = "";

  // Validación de campos vacíos
  if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['precio']) || empty($_POST['color']) || empty($_POST['tamano']) || empty($_POST['foto'])) {
    $alert = '<div class="alert alert-primary" role="alert">Todos los campos son obligatorios</div>';
  } else {
    // Recogiendo datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $color = $_POST['color'];
    $tamano = $_POST['tamano'];
    $foto = $_POST['foto'];
    $idcat = $_POST['idcat'];

    // Query para insertar el nuevo producto
    $consulta = mysqli_query($conexion, "INSERT INTO productos (nombre, descripcion, cantidad, precio, color, tamano, foto, idcat) VALUES ('$nombre', '$descripcion', '$cantidad', '$precio', '$color', '$tamano', '$foto', '$idcat')");

    // Verificar si la consulta fue exitosa
    if ($consulta) {
      header("Location: " . $_SERVER['PHP_SELF'] . "?insert=success");
      exit();
    } else {
      $alert = '<div class="alert alert-danger" role="alert">Error al guardar la información: ' . mysqli_error($conexion) . '</div>';
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
  <title>Hello, world!</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
  <header>
    <!--Encabezado-->
    <?php include_once("Vistas/encabezado.php"); ?>
  </header>
  <div class="container" style="text-align:center">
    <h2>Administración de Productos</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Nuevo Producto
    </button>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Precio</th>
          <th scope="col">Color</th>
          <th scope="col">Tamaño</th>
          <th scope="col">Foto</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $con = mysqli_query($conexion, "SELECT * FROM productos");
        while ($datos = mysqli_fetch_assoc($con)) {
        ?>
          <tr>
            <td><?php echo $datos['nombre']; ?></td>
            <td><?php echo $datos['descripcion']; ?></td>
            <td><?php echo $datos['cantidad']; ?></td>
            <td><?php echo $datos['precio']; ?></td>
            <td><?php echo $datos['color']; ?></td>
            <td><?php echo $datos['tamano']; ?></td>
            <td><?php echo $datos['foto']; ?></td>

            <td><a href="../Servidor/editar producto.php?id=<?php echo $datos['idprod']; ?>"><button type="button" class="btn btn-light"><i class="fi fi-rr-pencil"></i></button></a></td>
            <td><a href="../Servidor/borrar producto.php?id=<?php echo $datos['idprod']; ?>"><button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i></button></a></td>

          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST">
            <div><?php echo isset($alert) ? $alert : ""; ?></div>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Nombre</span>
              <input type="text" class="form-control" name="nombre">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Descripción</span>
              <input type="text" class="form-control" name="descripcion">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Cantidad</span>
              <input type="text" class="form-control" name="cantidad">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Precio</span>
              <input type="text" class="form-control" name="precio">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Color</span>
              <input type="text" class="form-control" name="color">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Tamaño</span>
              <input type="text" class="form-control" name="tamano">
            </div>
            <br>
            <div class="input-group flex-nowrap">
              <span class="input-group-text">Foto</span>
              <input type="file" class="form-control" name="foto">
            </div>
            <br>
            <select class="form-select" name="idcat">
              <?php
              $cone = mysqli_query($conexion, "SELECT * FROM categorias");
              while ($datos = mysqli_fetch_assoc($cone)) {
              ?>
                <option value="<?php echo $datos['idcat']; ?>"><?php echo $datos['categoria']; ?></option>
              <?php
              }
              ?>
            </select>
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