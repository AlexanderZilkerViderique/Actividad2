<?php
session_start();
require_once 'conexion.php';

$conexion = new Conexion();
$conexion->conectar();
$conn = $conexion->getConnection();

if (isset($_POST['comprar'])) {
    // Obtener el ID del producto enviado desde el formulario
    $producto_id = $_POST['producto_id'];
    
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario_id'])) {
        // Redirigir al usuario a iniciar sesión si no ha iniciado sesión
        $_SESSION['message'] = 'Debes iniciar sesión para agregar productos al carrito';
        $_SESSION['message_type'] = 'warning';
        header('Location: inicio_sesion.php');
        exit();
    }
    
    // Obtener el ID de usuario de la sesión
    $usuario_id = $_SESSION['usuario_id'];
    
    // Insertar el producto en el carrito
    $query_insertar = "INSERT INTO carrito_compras (id_usuario, id_pelicula, cantidad) VALUES ('$usuario_id', '$producto_id', 1)";
    
    if (mysqli_query($conn, $query_insertar)) {
        // Si la inserción fue exitosa, mostrar mensaje de éxito
        $_SESSION['message'] = 'Producto agregado al carrito';
        $_SESSION['message_type'] = 'success';
    } else {
        // Si hubo un error en la inserción, mostrar mensaje de error
        $_SESSION['message'] = 'Error al agregar el producto al carrito';
        $_SESSION['message_type'] = 'danger';
    }
    
    // Redirigir de vuelta a la página principal
    header('Location: menu.php');
    exit();
} else {
    // Si alguien trata de acceder directamente a este archivo sin enviar datos del formulario, redirigirlo al index
    header('Location: menu.php');
    exit();
}
?>


