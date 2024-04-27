<?php
    include("db.php");

    // Validación si existe guadar por el método POST
    if(isset($_POST['guardar'])){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        // Query para insertar datos de formulario en bd
        $query = "INSERT INTO lista (nombre, descripcion, precio) VALUES ('$nombre', '$descripcion', $precio)";
        $resultado = mysqli_query($conn, $query);

        // Si falla el envío o el query, corta el proceso
        if(!$resultado){
            die("Algo falló en envío a la bd");
        }

        // Guardar mensaje que se mostrará después de guardar
        $_SESSION['message'] = 'El artículo se guardó correctamente';
        // Color y tipo 'success' de mensaje en Bootstrap
        $_SESSION['message_type'] = 'success';

        // Redireccionar después de guardar
        header("Location: index.php");
    }
?>
