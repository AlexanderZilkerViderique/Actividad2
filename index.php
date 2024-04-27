<?php
require_once 'conexion.php';

$conexion = new Conexion();
$conexion->conectar();
$conn = $conexion->getConnection();

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Realizar la consulta SQL para verificar las credenciales
    $query = "SELECT id FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND contrasena = '$contrasena'";
    $resultado = mysqli_query($conn, $query);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión y redirigir al usuario a otra página
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['usuario_id'] = mysqli_fetch_assoc($resultado)['id']; // Guardar el ID del usuario en la sesión
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        header("Location: menu.php");
        exit();
    } else {
        // Mostrar un mensaje de error si las credenciales son incorrectas
        $mensaje_error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

<!-- Formulario de inicio de sesión -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="card-title">Iniciar sesión</h2>
                </div>
                <div class="card-body">
                    <?php if(isset($mensaje_error)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $mensaje_error; ?>
                        </div>
                    <?php } ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="nombre_usuario" class="form-label">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>