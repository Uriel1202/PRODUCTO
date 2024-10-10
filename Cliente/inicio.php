<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consolas Demo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <header>
    <!--Encabezado-->
    <?php include_once("Vistas/encabezado.php"); ?>
  </header>
  <div class="container" style="font-family: 'Times New Roman', Times, serif; font-weight:800; font-size:0.75cm;">
    <p><?php echo $_SESSION['nombre'];
        echo " ";
        echo $_SESSION['paterno'];
        echo " ";
        echo $_SESSION['materno']; ?></p>
  </div>
  <div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="Recursos/Produc1.jpg" class="d-block w-100" alt="fondo" width="80px" height="250px">
        </div>
        <div class="carousel-item">
          <img src="Recursos/Produc2.jpg" class="d-block w-100" alt="fondo2" width="80px" height="250px">
        </div>
        <div class="carousel-item">
          <img src="Recursos/Produc3.jpg" class="d-block w-100" alt="fondo3" width="80px" height="250px">
        </div>
        <div class="carousel-item">
          <img src="Recursos/Produc4.jpg" class="d-block w-100" alt="fondo4" width="80px" height="250px">
        </div>
        <div class="carousel-item">
          <img src="Recursos/Produc5.jpg" class="d-block w-100" alt="fondo5" width="80px" height="250px">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!--FIN DE CARRUSEL-->
  <footer style="position: absolute; bottom: 0; width: 100%; height: 40px;">
    <!-- inicia pie-->
    <?php include_once("Vistas/pie.php"); ?>
    <!--fin pie-->
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script>
</body>

</html>