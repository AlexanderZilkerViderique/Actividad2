<?php
    session_start(); // Inicia la sesión si aún no se ha iniciado
    require_once 'conexion.php';

    $conexion = new Conexion();
    $conexion->conectar();
    $conn = $conexion->getConnection();
        

    // Valiadación si existe un id
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM carrito_compras WHERE id = $id"; // Eliminar el elemento de la tabla carrito_compras

        $resultado = mysqli_query($conn, $query);

        // Si falla algo en el query
        if(!$resultado){
            die("Falló la consulta de eliminación");
        }
        // Guardar mensaje que se mostrará después de borrar
        $_SESSION['message'] = 'Se eliminó correctamente del carrito de compras';
        // Color y tipo 'danger' de mensaje en Bootstrap
        $_SESSION['message_type'] = 'danger';

        // Redireccionar si borra resultado correctamente
        header("Location: carrito.php");
    }
?>
