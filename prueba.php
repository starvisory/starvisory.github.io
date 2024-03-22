<?php

include "conexion_db.php";
error_reporting(0);
session_start();

$error = "";

$correct = "";

if (isset($_SESSION["token"])) {
    header("Location: panel.php");
    exit();
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if(strlen($username) < 3){
    	$error = "Por favor, el usuario debe tener al menos 3 caracteres";
    }elseif (empty($email)) {
        $error = "Por favor, ingrese su correo electrónico";
    } else if (strlen($password) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres";
        $username = "";
        $email = "";
        $_POST["password"] = "";
        $_POST["cpassword"] = "";
    } else if ($password == $cpassword) {
        $check_email = "SELECT * FROM usuario WHERE email='$email'";
        $result = mysqli_query($conexion, $check_email);
        if (mysqli_num_rows($result) == 0) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (username, email, password, Id_Rol) VALUES ('$username', '$email', '$hashed_password', 2)";
            if (mysqli_query($conexion, $sql)) {
            	 $correct  = "Usuario registrado correctamente";
                $username = "";
                $email = "";
                $_POST["password"] = "";
                $_POST["cpassword"] = "";
                
               