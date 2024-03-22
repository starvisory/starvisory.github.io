<?php
require_once 'MVC/modelo/conexion.php';
require_once 'MVC/modelo/cerrar_sesion.php'; // Agrega esta línea para incluir el código de cerrar_sesion.php

// No es necesario llamar a session_start() aquí si ya se ha iniciado en cerrar_sesion.php u otro lugar.

// Verificar si el usuario ha iniciado sesión y si las validaciones de ID y correo electrónico fueron exitosas
if (!isset($_SESSION['name']) || !isset($_SESSION['id']) || !isset($_SESSION['email'])) {
    echo '<script>alert("Favor de iniciar sesión primero"); window.location = "Login.php";</script>';
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="MVC/vista/img2/logo.png"> 
  <title>Star Visory</title>
  <link rel="stylesheet" type="text/css" href="MVC/vista/userestilo.css">
</head>
<body>
<nav class="menu"> 
    <ul id="menu-desplegable">
        <li><a href="index.html">Inicio</a></li>
        <li><a href="Deportes.html">Visorías</a></li>
        <li><a href="quienessomos.html">Acerca De</a></li>
        <li><a href="MVC/modelo/mensaje.php">Datos</a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
        <li><a href="Login.php">Inicio Sesión</a></li>
    </ul>
</nav>
<h1>Usuarios Registrados</h1>
<a href="Registro.php">Regresar</a>

<?php
// Consultar los datos de la tabla de usuarios
$sql = "SELECT * FROM users";
$resultado = mysqli_query($conn, $sql);

// Crear una tabla HTML para mostrar los datos
echo "<table>";
echo "<tr><th>Usuario</th><th>Contraseña</th><th>Email</th><th>Rol</th><th>Editar</th><th>Eliminar</th></tr>";

// Mostrar los datos en la tabla HTML
while ($fila = mysqli_fetch_assoc($resultado)) {
  echo "<tr>";
  echo "<td>" . $fila["name"] . "</td>";
  echo "<td>" . $fila["password"] . "</td>";
  echo "<td>" . $fila["email"] . "</td>";
  echo "<td>" . $fila["rol_id"] . "</td>";
  echo '<td><a href="MVC/controlador/update.php?id='.$fila['id'].'">Editar</a></td>';
  echo '<td><a href="MVC/controlador/delete.php?id='.$fila['id'].'">Eliminar</a></td>';
  echo "</tr>";
}
echo "</table>";

// Liberar la memoria del resultado
mysqli_free_result($resultado);

// Cerrar la conexión
mysqli_close($conn);
?>

<a href="#" onclick="cerrarSesion()">Cerrar Sesión</a> <!-- Cambiado a un enlace que llama a la función cerrarSesion() -->

<script>
    // Función para cerrar sesión manualmente
    function cerrarSesion() {
        // Enviar una solicitud POST a cerrar_sesion.php
        fetch('MVC/modelo/cerrar_sesion.php', {
            method: 'POST',
            body: new URLSearchParams({ 'cerrar_sesion': 'true' }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => {
            // Redirigir al usuario al formulario de inicio de sesión
            window.location.href = "Login.php";
        })
        .catch(error => console.error('Error:', error));
    }

    // Establecer temporizador de sesión
    let temporizadorSesion;

    function reiniciarTemporizadorSesion() {
        clearTimeout(temporizadorSesion);
        temporizadorSesion = setTimeout(cerrarSesion, 900000); // 15 minutos en milisegundos
    }

    // Reiniciar temporizador cada vez que ocurra una acción del usuario
    document.addEventListener('mousemove', reiniciarTemporizadorSesion);
    document.addEventListener('keydown', reiniciarTemporizadorSesion);

    // Iniciar temporizador al cargar la página
    reiniciarTemporizadorSesion();
</script>
</body>
</html>
