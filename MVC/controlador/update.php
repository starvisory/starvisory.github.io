<?php
require_once '../modelo/conexion.php';
session_start();

if(!isset($_SESSION['usuario'])){
  echo '<script> alert("Favor de iniciar sesión primero"); 
  window.location = "Login.php";
  </script>';

  session_destroy();
  die();
}

// Obtener el ID del usuario que se va a actualizar
$id = $_GET['id'];

// Consultar los datos del usuario
$sql = "SELECT * FROM StarVisory WHERE id = $id";
$resultado = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($resultado);

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST['actualizar'])) {
  // Obtener los datos actualizados del formulario
  $usuario = $_POST['usuario'];
  $contraseña = $_POST['contraseña'];
  $email = $_POST['email'];

  // Actualizar los datos en la base de datos
  $sql = "UPDATE StarVisory SET usuario = '$usuario', contraseña = '$contraseña', email = '$email' WHERE id = $id";
  mysqli_query($conexion, $sql);

  // Redirigir a la página de usuarios registrados
  header('Location: ../../usuarios.php');
  die();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SV - Actualizar Usuario</title>
</head>
<body>
  <a href="../../usuarios.php">Regresar</a>

  <h1>Actualizar Usuario</h1>

  <form method="post">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" value="<?php echo $fila['usuario']; ?>" required><br>

    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña" value="<?php echo $fila['contraseña']; ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $fila['email']; ?>" required><br>

    <input type="submit" name="actualizar" value="Actualizar">
  </form>

</body>
</html>

