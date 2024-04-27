<?php
// Variables de conexión (no necesitan ser private)
$servername = "mysql";
$port = "3306";
$username = "root";
$password = "root";
$dbname = "crud_compras";
$conn;

// Inicio de la sesión
session_start();

// Intento de conexión a la base de datos
try {
    $conn = mysqli_connect(
        $servername,
        $username,
        $password,
        $dbname,
        $port
    );

    if (!$conn) {
        throw new mysqli_sql_exception(mysqli_connect_error());
    }

    // Si deseas mostrar un mensaje de conexión exitosa, descomenta la siguiente línea
    // echo 'La conexión a la BD fue exitosa';
}
catch (mysqli_sql_exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
