<?php
$servername = "db"; // localhost
$username = "mariadb"; // nombre de usuario de MariaDB
$password = "mariadb"; // contraseña de MariaDB
$database = "mariadb"; // El nombre de tu base de datos

// Crear una conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
