<?php

include 'conexion.php';

$usuario = $_POST['name'];
$email = $_POST['email'];
$contrasena = $_POST['password'];

//Encriptar contraseña
$contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

// Conexión a la base de datos
$conexion = conectarBD();

// Consulta para obtener el ID del rol predeterminado (común)
$rol_query = "SELECT id FROM roles WHERE name = 'común'";
$resultado_rol = mysqli_query($conexion, $rol_query);
$fila_rol = mysqli_fetch_assoc($resultado_rol);
$rol_id = $fila_rol['id'];

// Preparar la consulta para insertar el usuario en la tabla users
$query = "INSERT INTO users (name, password, email, rol_id) VALUES ('$usuario', '$contrasena_encriptada', '$email', '$rol_id')";

// Ejecutar la consulta
$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '<script>
    alert("Usuario Registrado Exitosamente");
    window.location = "../../Registro.php";
    </script>';
} else {
    echo '<script>
    alert("Inténtalo de nuevo, usuario no registrado");
    window.location = "../../Registro.php";
    </script>';
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>
