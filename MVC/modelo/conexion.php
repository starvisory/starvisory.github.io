<?php
$servername = "localhost"; // localhost
$username = "root"; // nombre de usuario de MariaDB
$password = "contra"; // contraseña de MariaDB
$database = "mysql"; // El nombre de tu base de datos

// Crear una conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
echo "Conexión exitosa";
?>