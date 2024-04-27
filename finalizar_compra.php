<?php
session_start(); // Inicia la sesión si aún no se ha iniciado
require_once 'conexion.php';

$conexion = new Conexion();
$conexion->conectar();
$conn = $conexion->getConnection();

// Obtener el id_usuario desde la sesión
$id_usuario = $_SESSION['usuario_id'];

// Consulta para obtener los datos del carrito de compras del usuario actual
$query_carrito = "SELECT carrito_compras.id_pelicula, peliculas.precio 
                  FROM carrito_compras 
                  INNER JOIN peliculas ON carrito_compras.id_pelicula = peliculas.id 
                  WHERE carrito_compras.id_usuario = $id_usuario";

// Ejecutar la consulta
$resultado_carrito = mysqli_query($conn, $query_carrito);

// Inicializar el precio total
$precio_total = 0;

// Iterar sobre los elementos del carrito para calcular el precio total y agregarlos a lista_compra
while ($row = mysqli_fetch_array($resultado_carrito)) {
    $precio_unitario = $row['precio'];
    $precio_total += $precio_unitario;
}

// Insertar datos en la tabla lista_compra
$query_insert = "INSERT INTO lista_compra (id_usuario, precio_total) VALUES ($id_usuario, $precio_total)";
if (mysqli_query($conn, $query_insert)) {
    // Eliminar los datos del carrito_compras para el usuario actual
    $query_delete = "DELETE FROM carrito_compras WHERE id_usuario = $id_usuario";
    mysqli_query($conn, $query_delete);

    // Redireccionar de vuelta a la página de carrito.php con un mensaje de éxito
    $_SESSION['message'] = 'Compra finalizada exitosamente';
    $_SESSION['message_type'] = 'success';
    header("Location: carrito.php");
} else {
    // Si hay un error, redireccionar a la página de carrito.php con un mensaje de error
    $_SESSION['message'] = 'Error al finalizar la compra';
    $_SESSION['message_type'] = 'danger';
    header("Location: carrito.php");
}

// Cerrar la conexión a la base de datos
$conexion->cerrar();
?>




