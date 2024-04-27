<?php 
    session_start(); // Inicia la sesión si aún no se ha iniciado
    require_once 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE COMPRAS</title>
    <!-- Bootstrap 5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Font Awesome para iconos de botones-->
    <script src="https://kit.fontawesome.com/07ff07af43.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container">
        <a href="#" class="navbar-brand">
            <i class="fas fa-shopping-cart"></i> LISTA DE COMPRAS
        </a>
        <!-- Agregar el enlace para ir a la página de inicio de sesión -->
        <a href="index.php" class="btn btn-light">Iniciar sesión</a>
        <!-- Agregar botón para finalizar compra -->
        <a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>
    </div>
</nav>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <!-- Mensaje de guardado mediante variable de sesión en db.php -->
            <!-- Validar si existe el valor 'mensaje' -->
            <?php if(isset($_SESSION['message'])) {?>
                <div class="alert alert-<?=$_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['message']); // Eliminar solo la variable 'message' ?>
            <?php } ?>

            <!-- Tabla para ver artículos en BD -->
            <div class="col-md-8">
                <table class="table table-bordered">
                    <!-- Encabezados de la tabla -->
                    <thead>
                        <tr>
                            <th>Artículo</th>
                            <th>Precio</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conexion = new Conexion();
                        $conexion->conectar();
                        $conn = $conexion->getConnection();
                        $suma = 0; // Inicializar la suma
                        $query = "SELECT peliculas.nombre AS nombre_pelicula, peliculas.precio, carrito_compras.id 
                                  FROM carrito_compras 
                                  INNER JOIN peliculas ON carrito_compras.id_pelicula = peliculas.id";
                        $resultado_lista = mysqli_query($conn, $query);
                        
                        while($row = mysqli_fetch_array($resultado_lista)){
                            $suma += $row['precio']; 
                        ?>
                            <!-- Filas de la tabla -->
                            <tr>
                                <td><?php echo $row['nombre_pelicula']?></td>
                                <td><?php echo $row['precio']?></td>
                                <!-- Iconos de acciones editar, borrar -->
                                <td>
                                    <a href="editar.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="eliminar.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!-- Fila para mostrar la suma -->
                    <tfoot>
                        <tr>
                            <td colspan="1" style="text-align: right;">Total:</td>
                            <td><?php echo $suma; ?></td>
                            <td></td> <!-- Columna vacía para mantener la alineación -->
                        </tr>
                    </tfoot>
                    <?php $conexion->cerrar(); // Cerrar la conexión después de usarla ?>
                </table>
                <!-- Agregar el enlace para ver la facturación -->
                    <a href="facturacion.php" class="btn btn-primary">Ver Facturación</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>


