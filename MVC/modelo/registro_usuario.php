<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Verificar si se recibieron los datos correctamente
    if (empty($usuario) || empty($email) || empty($contrasena)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Encriptar contraseña
    $contrasena_encriptada = password_hash($contrasena, PASSWORD_BCRYPT);

    // Preparar la consulta para obtener el ID del rol predeterminado (común)
    $rol_query = "SELECT id FROM roles WHERE id = '2'";
    $resultado_rol = mysqli_query($conn, $rol_query);
    if (!$resultado_rol) {
        die("Error en la consulta de roles: " . mysqli_error($conn));
    }

    $fila_rol = mysqli_fetch_assoc($resultado_rol);
    if (!$fila_rol) {
        die("No se encontró el rol predeterminado '2'");
    }

    $rol_id = $fila_rol['id'];

    // Preparar la consulta para insertar el usuario en la tabla users
    $query = "INSERT INTO users (name, password, email, rol_id) VALUES ('$usuario', '$contrasena_encriptada', '$email', '$rol_id')";

    // Ejecutar la consulta
    $ejecutar = mysqli_query($conn, $query);
    if (!$ejecutar) {
        die("Error en la inserción: " . mysqli_error($conn));
    }

    echo '<script>
    alert("Usuario Registrado Exitosamente");
    window.location = "../../Registro.php";
    </script>';
} else {
    echo "Error: Este script solo se puede acceder mediante una solicitud POST.";
}
?>
