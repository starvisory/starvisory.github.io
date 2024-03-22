<?php
session_start();

if (!isset($_SESSION["token"])) {
    header("Location: login.php");
    exit();
} else {
    require_once "conexion_db.php"; 

    $token = $_SESSION["token"];

    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location: login.php");
        exit();
    } else {
        $row = $result->fetch_assoc();
        if (isset($row['Id_Rol'])) {
            $rol = $row['Id_Rol'];
        } else {
            $rol = 0; 
        }
    }
}
?>