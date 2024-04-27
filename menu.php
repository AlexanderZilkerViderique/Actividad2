<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Películas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Catálogo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="carrito.php">Carrito</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Slider -->
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    require_once 'conexion.php';
    $conexion = new Conexion();
    $conexion->conectar();
    $conn = $conexion->getConnection();

    $query_slider = "SELECT * FROM peliculas LIMIT 3";
    $resultado_slider = mysqli_query($conn, $query_slider);
    $active = true;
    while ($row_slider = mysqli_fetch_assoc($resultado_slider)) {
        $active_class = $active ? 'active' : '';
        echo '<div class="carousel-item ' . $active_class . '">';
        echo '<img src="' . $row_slider['imagen'] . '" class="d-block w-100" style="object-fit: cover; height: 400px;" alt="' . $row_slider['nombre'] . '">';
        echo '</div>';
        $active = false;
    }
    ?>
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

<!-- Product Boxes -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Catálogo de Películas</h2>
  <div class="row row-cols-1 row-cols-md-4 g-4">
    <?php
    $query_products = "SELECT * FROM peliculas LIMIT 10";
    $resultado_products = mysqli_query($conn, $query_products);
    while ($row_product = mysqli_fetch_assoc($resultado_products)) {
        echo '<div class="col">';
        echo '<div class="card h-100">';
        echo '<img src="' . $row_product['imagen'] . '" class="card-img-top" style="object-fit: cover; height: 200px;" alt="' . $row_product['nombre'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row_product['nombre'] . '</h5>';
        echo '<p class="card-text">' . $row_product['descripcion'] . '</p>';
        echo '<p class="card-text">$' . $row_product['precio'] . '</p>';
        // Agregar el botón de compra con icono
        echo '<form action="agregar_al_carrito.php" method="POST">';
        echo '<input type="hidden" name="producto_id" value="' . $row_product['id'] . '">';
        echo '<button type="submit" class="btn btn-primary" name="comprar">';
        echo '<i class="fas fa-cart-plus"></i> Comprar';
        echo '</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
  </div>
</div>


<!-- Bootstrap JS (opcional, dependiendo de tu necesidad) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>