<?php
session_start(); // Inicia la sesión si aún no se ha iniciado
require_once 'conexion.php';

$conexion = new Conexion();
$conexion->conectar();
$conn = $conexion->getConnection();

// Obtener el id_usuario desde la sesión
$id_usuario = $_SESSION['usuario_id'];

// Consulta para obtener los datos de facturación del usuario desde la tabla lista_compra
$query_facturacion = "SELECT * FROM lista_compra WHERE id_usuario = $id_usuario";
$resultado_facturacion = mysqli_query($conn, $query_facturacion);

// Cerrar la conexión a la base de datos
$conexion->cerrar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Datos de Facturación</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Fecha de Compra</th>
                    <th>Precio Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado_facturacion)) { ?>
                <tr>
                    <td><?php echo $row['fecha_compra']; ?></td>
                    <td>$<?php echo $row['precio_total']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>