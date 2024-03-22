<?php

// Función para conectar a la base de datos
function conectarBD() {
    $servername = "db"; // Puedes necesitar cambiar esto si tu servidor de base de datos no está en localhost
    $username = "mariadb"; // Tu nombre de usuario de MariaDB
    $password_db = "mariadb"; // Tu contraseña de MariaDB
    $dbname = "mariadb"; // El nombre de tu base de datos (ajustar según corresponda)

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Error en la conexión a la base de datos:" . $conn->connect_error);
    }

    return $conn;
}

// Validación del lado del servidor para el formulario de inicio de sesión
function validarFormularioLogin($email, $contrasena) {
    // Validación del email con expresión regular
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Error: Formato de correo electrónico inválido.";
    }

    // Validación de la longitud de la contraseña
    if (strlen($contrasena) < 8) {
        return "Error: La contraseña debe tener al menos 8 caracteres.";
    }

    return "";
}

// Iniciar sesión del usuario después de las validaciones del formulario de inicio de sesión
function iniciarSesion($email, $contrasena) {
    $conn = conectarBD();

    // Consulta a la base de datos filtrada por correo
    $sql = "SELECT id, name, password, email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontraron resultados en la consulta
    if ($stmt->num_rows == 0) {
        return "Error: No se encontró ningún usuario con ese correo electrónico.";
    }

    // Vincular variables de resultado
    $stmt->bind_result($id, $name, $password_bd, $email_bd);
    $stmt->fetch();

    // Comparar la contraseña cifrada con la contraseña proporcionada
    if (!password_verify($contrasena, $password_bd)) {
        return "Error: La contraseña proporcionada es incorrecta.";
    }

    // Iniciar sesión
    session_start();
    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email_bd;

    return "Inicio de sesión exitoso.";
}

// Función para validar que el usuario ha iniciado sesión en la aplicación
function validarSesion() {
    // Iniciar sesión si no está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si el ID y el correo electrónico del usuario están presentes en la sesión
    if (!isset($_SESSION["id"]) || !isset($_SESSION["email"])) {
        // Si no están presentes, redirigir al formulario de inicio de sesión
        header("Location: ../../Login.php");
        exit;
    }

    

    // Conexión a la base de datos
    $conn = conectarBD();

    // Consulta a la base de datos para validar que el ID y el correo existen
    $sql = "SELECT rol_id FROM users WHERE id = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $_SESSION["id"], $_SESSION["email"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location: ../../Login.php");
        exit();
    } else {
        $row = $result->fetch_assoc();
        if (isset($row['rol_id'])) {
            $rol = $row['rol_id'];
        } else {
            $rol = 0; 
        }
    }

    // Verificar si se encontraron resultados en la consulta
    if ($result->num_rows == 0) {
        // Si no se encuentran en la base de datos, redirigir al formulario de inicio de sesión
        header("Location: ../../Login.php");
        exit;
    }

    // Si se encuentran en la base de datos, cargar en la sesión el rol del usuario
    $row = $result->fetch_assoc();
    $_SESSION["rol_id"] = $row["rol_id"];
}

// Validación del lado del servidor para el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];

    // Validar el formulario de inicio de sesión
    $error = validarFormularioLogin($email, $contrasena);
    if ($error !== "") {
        echo "<script>alert('$error'); window.location.href = '../../Login.php';</script>";
        exit;
    }

    // Iniciar sesión del usuario después de las validaciones del formulario
    $mensaje = iniciarSesion($email, $contrasena);
    if ($mensaje === "Inicio de sesión exitoso.") {
        echo "<script>alert('$mensaje'); window.location.href = '../../Deportes.html';</script>";
        exit;
    } else {
        echo "<script>alert('$mensaje'); window.location.href = '../../Login.php';</script>";
        exit;
    }
}

// Validar que el usuario ha iniciado sesión en la aplicación
validarSesion();

?>
