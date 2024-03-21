<?php
session_start();

// Destruir la sesión si está activa
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > 900)) {
    session_unset();     // Desactiva todas las variables de sesión
    session_destroy();   // Destruye la sesión
    header("location: ../../Login.php"); // Redirecciona al usuario al formulario de inicio de sesión
    exit(); // Termina la ejecución del script
}

// Actualizar el tiempo de último acceso
$_SESSION['ultimo_acceso'] = time();

// Destruir la sesión si se selecciona el botón "cerrar sesión"
if (isset($_POST['cerrar_sesion'])) {
    session_unset();     // Desactiva todas las variables de sesión
    session_destroy();   // Destruye la sesión
    header("location: ../../Login.php"); // Redirecciona al usuario al formulario de inicio de sesión
    exit(); // Termina la ejecución del script
}
?>
