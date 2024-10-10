<?php
$alert = "";
//session_start();
include_once("../Servidor/conexion.php");
if (!empty($_POST)) {
  if (empty($_POST['can1']) || empty($_POST['can2']) || empty($_POST['can3']) || empty($_POST['can4']) || empty($_POST['can5']) || empty($_POST['can6']) || empty($_POST['can7'])) {
    $alert = '<div class = "alert alert-primary" role="alert"> Todos los datos son obligatorios
           </div';
  } else {
    $c1 = $_POST['can1'];
    $c2 = $_POST['can2'];
    $c3 = $_POST['can3'];
    $c4 = $_POST['can4'];
    $c5 = $_POST['can5'];
    $c6 = $_POST['can6'];
    $c7 = $_POST['can7'];
    $c8 = md5($_POST['can5']);
    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE Correo = '$c4'");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert = '<div class= "alert alert-danger" role="alert"> El correo ya existe </div>';
    } else {
      $consulta = mysqli_query($conexion, "INSERT INTO usuarios(NomUsu, ApaUsu, AmaUsu, Correo, Contra, telefono, idtipo)  values ('$c1', '$c2', '$c3', '$c4', '$c8', '$c6', '$c7')");
      if ($consulta) {
        $alert = '<div class= "alert alert-danger" role="alert" Usuario insertado </div>';
      } else {
        $alert = '<div class= "alert alert-danger" role="alert" Error al insertar el usuario </div>';
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
  <title>Hello, world!</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
  <header>
    <!--Encabezado-->
    <?php include_once("Vistas/encabezado.php"); ?>
  </header>
  <div class="container" style="text-align: center;">
    <h2>Administración de Usuarios</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Agregar nuevo usuario
    </button>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido Paterno</th>
          <th scope="col">Apellido Materno</th>
          <?php if ($_SESSION['rol'] == 1) { ?>
            <th scope="col">Correo</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Tipo de usuario</th>
            <th scope="col">Acciones</th>
          <?php
          } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        include_once("../Servidor/conexion.php");
        $con = mysqli_query($conexion, "SELECT u.idusuario, u.NomUsu, u.ApaUsu, u.AmaUsu, u.Correo, u.telefono, t.tipousu  FROM usuarios u INNER JOIN tipousuarios t ON u.idtipo=t.idtipo;");
        $res = mysqli_num_rows($con);
        while ($datos = mysqli_fetch_assoc($con)) {
        ?>

          <tr>
            <td><?php echo $datos['NomUsu']; ?></td>
            <td><?php echo $datos['ApaUsu']; ?></td>
            <td><?php echo $datos['AmaUsu']; ?></td>


            <?php if ($_SESSION['rol'] == 1) { ?>
              <td><?php echo $datos['Correo']; ?></td>
              <td><?php echo $datos['telefono']; ?></td>
              <td><?php echo $datos['tipousu']; ?></td>
              
              <td><a href="../Servidor/editar usuario.php?id=<?php echo $datos['idusuario']; ?>"><button type="button" class="btn btn-light"><i class="fi fi-rr-pencil"></i></button></a></td>
              <td><a href="../Servidor/borrar usuario.php?id=<?php echo $datos['idusuario']; ?>"><button type="button" class="btn btn-danger"><i class="fi fi-rr-trash"></i></button></a></td>
            <?php
            } ?>
          </tr>

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
            <h5 class="modal-title" id="exampleModalLabel">Registro de usuarios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form style="padding: 25px;" method="POST">
              <div>
                <?php echo isset($alert) ? $alert : ""; ?>
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Nombre(s)</label>
                <input type="text" class="form-control" id="can1" name="can1" placeholder="Nombre(s)">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Apellido Paterno </label>
                <input type="text" class="form-control" id="can2" name="can2" placeholder="Example input placeholder">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Apellido Materno</label>
                <input type="text" class="form-control" id="can3" name="can3" placeholder="Example input placeholder">
              </div>
              <div class="form-group">
                <label for="formGroupExampleInput">Teléfono</label>
                <input type="text" class="form-control" id="can6" name="can6" placeholder="Example input placeholder">
              </div>
              <div>
              </div>
              <select class="form-select" aria-label="Default select example" id="can7" name="can7">
                <option selected>Tipo de usuario</option>
                <?php
                include_once("../Servidor/conexion.php");
                $cone = mysqli_query($conexion, "SELECT * FROM tipousuarios");
                $res = mysqli_num_rows($cone);
                while ($dat = mysqli_fetch_assoc($con)) {
                ?>
                  <option value=<?php echo  $dat['idtipo']; ?><?php $datos['tipousu']; ?>></option>
                <?php
                }
                ?>

                <option value="1">Administrador</option>
                <option value="2">Gerente</option>
                <option value="3">Empleado </option>
                <option value="4">Cliente </option>
              </select>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label" >Correo electrónico</label>
                <input type="email" class="form-control" id="can4" aria-describedby="emailHelp" name="can4">
                <div id="emailHelp" class="form-text">No olvides ingresar tus datos!!.
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="can5" name="can5">
              </div>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
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
    <!--Termina modal-->
  <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">
    <?php include_once("Vistas/pie.php"); ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>