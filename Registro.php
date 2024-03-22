<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="MVC/vista/styles2.css">
    <link rel="shortcut icon" href="MVC/vista/img2/logo.png"> 
    <script type="text/javascript" src="MVC/vista/js/funciones.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var form = document.getElementById("validationForm");
            form.addEventListener("submit", event => {
                var email = document.getElementById("emailReg");
                var contraseña = document.getElementById("contraseñaReg");
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                var isValidEmail = filter.test(email.value);
                var isValidContraseña = contraseña.value.length >= 8;
                if (!isValidEmail) {
                    console.log("Email no válido");
                    email.classList.add("is-invalid");
                } else {
                    email.classList.remove("is-invalid");
                }
                if (!isValidContraseña) {
                    console.log("Contraseña no válida");
                    contraseña.classList.add("is-invalid");
                } else {
                    contraseña.classList.remove("is-invalid");
                }
                if (!(isValidEmail && isValidContraseña)) {
                    event.preventDefault();
                }
            });
        });
    </script>
</head>
<body>
    <nav class="menu">
        <div class="hamburguesa" onclick="mostrar()">
            <span></span><span></span><span></span>
        </div>
        <label class="logo">Star Visory</label>
        <ul id="menu-desplegable">
            <li><span class="cerrar" onclick="ocultar()">X</span></li>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="Deportes.html">Visorías</a></li>
            <li><a href="quienessomos.html">Acerca De</a></li>
            <li><a href="usuarios.php">Usuarios</a></li>
            <li><a href="Login.php">Inicio Sesión</a></li>
        </ul>
    </nav>

    <header>
        <h1>Registro de Usuario</h1>
    </header>

    <div class="wrapper">
        <div class="form-box login">
            <h2>Registro</h2>
            <form id="validationForm" action="MVC/modelo/registro_usuario.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <input id="usuarioReg" name="usuario" type="text" onclick="showPlaceholderUsuarioReg()" onblur="hidePlaceholderUsuarioReg()" maxlength="20" required>
                    <label>Usuario</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input id="emailReg" type="email" name="email" onclick="showPlaceholderEmailReg()" onblur="hidePlaceholderEmailReg()" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="key-outline"></ion-icon></span>
                    <input id="contraseñaReg" type="password" name="contrasena" onclick="showPlaceholderContraReg()" onblur="hidePlaceholderContraReg()" required>
                    <label>Contraseña</label>
                </div>
                <div class="Condiciones">
                    <label><input type="checkbox" required>Aceptar términos y condiciones</label>
                </div>
                <button type="submit" class="btnRegistro">Registrarme</button>
                <div class="login-register">
                    <p>¿Ya tienes una cuenta? <a href="Login.php" class="register-link">Iniciar Sesión</a></p>
                </div>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</body>
</html>
